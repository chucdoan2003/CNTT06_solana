<!DOCTYPE html>
<html>
<head>
    <title>Create NFT</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/@solana/web3.js@latest/lib/index.iife.js"></script>
    <script src="https://unpkg.com/@solana/web3.js@latest/lib/index.iife.min.js"></script>
</head>
<body>
    <h1>Create NFT Collection</h1>
    <form action="/create-nft" method="POST">
        @csrf
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="collection_name" ><br><br>
        
        <label for="symbol">Symbol:</label><br>
        <input type="text" id="symbol" name="symbol" ><br><br>
        
        <label for="description">Description:</label><br>
        <textarea id="description" name="description" ></textarea><br><br>
        
        <input type="submit" value="Create">
    </form>

    <!-- Import the Solana Web3.js library -->
    <script>
        async function createNFT() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Fetch encoded transaction from your Laravel backend
            const response = await fetch('/create-nft', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    // Include necessary data from your form fields
                }),
            });

            const data = await response.json();

            if (data.message === 'NFT Created Successfully!') {
                const encodedTransaction = data.data.encoded_transaction;

                // Log the encoded transaction to the console
                console.log("Encoded Transaction:", encodedTransaction);

                try {
                    // Decode the encoded transaction to a Uint8Array
                    const transactionBytes = Uint8Array.from(atob(encodedTransaction), c => c.charCodeAt(0));

                    // Initialize Solana Web3 instance
                    const solanaWeb3 = window['solanaWeb3'];

                    // Check if solanaWeb3 is defined
                    if (solanaWeb3) {
                        // Create a Solana Transaction object
                        const transaction = new solanaWeb3.Transaction(transactionBytes);

                        // Request Phantom Wallet to sign the transaction
                        const { solana } = window;
                        if (solana && solana.isPhantom) {
                            try {
                                // Sign the transaction using Phantom Wallet
                                const signedTransaction = await solana.signTransaction(transaction);

                                // Encode the signed transaction to base64
                                const signedTransactionBase64 = btoa(String.fromCharCode(...new Uint8Array(signedTransaction.serialize())));

                                // Send the signed transaction to Solana Devnet
                                const sendResponse = await fetch('https://api.devnet.solana.com', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                    },
                                    body: JSON.stringify({
                                        method: 'sendTransaction',
                                        params: [signedTransactionBase64, { encoding: 'base64' }],
                                        id: 1,
                                        jsonrpc: '2.0',
                                    }),
                                });

                                const sendResult = await sendResponse.json();

                                if (sendResult.result) {
                                    alert('Transaction sent successfully!');
                                } else {
                                    console.error('Error sending transaction:', sendResult);
                                    alert('Failed to send the transaction.');
                                }
                            } catch (error) {
                                console.error('Error signing transaction:', error);
                                alert('Failed to sign the transaction.');
                            }
                        } else {
                            alert('Phantom Wallet not found.');
                        }
                    } else {
                        console.error('solanaWeb3 is not defined.');
                        alert('Error: solanaWeb3 is not defined.');
                    }
                } catch (error) {
                    console.error('Error decoding transaction:', error);
                    alert('Failed to decode the transaction.');
                }
            } else {
                alert('Failed to create NFT.');
            }
        }
    </script>
</body>
</html>
