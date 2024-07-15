<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shyft NFT Creation</title>
    <script src="https://cdn.jsdelivr.net/npm/@solana/web3.js@latest/lib/index.iife.js"></script>
    <script src="https://unpkg.com/@solana/web3.js@latest/lib/index.iife.min.js"></script>
</head>
<body>
    <button onclick="createNFT()">Create NFT</button>

    <script>
        async function createNFT() {
            var myHeaders = new Headers();
            myHeaders.append("x-api-key", "JwjL_ALgf3syYbXi");
            myHeaders.append("Content-Type", "application/json");

            var raw = JSON.stringify({
                "network": "devnet",
                "metadata_uri": "https://brown-loyal-stoat-734.mypinata.cloud/ipfs/QmR5Tyx3MvpiCKtjTVC4wVzRigpujCv9bnvQKU4ZMQzN5N",
                "max_supply": 0,
                "collection_address": "3F3G122hfRQ6E7aRQLhdXvabxtfhGHF89UVLvHR4pmn9",
                "receiver": "5gTrAW9WANnqV71PBZHy7QqHcYaTbhmDuiU767Eai4js",
                "fee_payer": "5gTrAW9WANnqV71PBZHy7QqHcYaTbhmDuiU767Eai4js",
                "service_charge": {
                    "receiver": "5gTrAW9WANnqV71PBZHy7QqHcYaTbhmDuiU767Eai4js",
                    "amount": 0.01
                },
                "priority_fee": 100
            });

            var requestOptions = {
                method: 'POST',
                headers: myHeaders,
                body: raw,
                redirect: 'follow'
            };

            try {
                const response = await fetch("https://api.shyft.to/sol/v1/nft/create_from_metadata", requestOptions);
                const result = await response.json();
                console.log(result);

                if (response.ok && result.success) {
                    alert("NFT mint request generated successfully!");
                    // Tiếp tục ký giao dịch với Phantom
                    const encodedTransaction = result.result.encoded_transaction;
                    await signAndSendTransaction(encodedTransaction);
                } else {
                    alert("Failed to create NFT: " + result.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert("Failed to create NFT.");
            }
        }

        async function signAndSendTransaction(encodedTransaction) {
            try {
                // Kết nối với Phantom Wallet
                const provider = window.solana;
                if (!provider || !provider.isPhantom) {
                    alert("Phantom Wallet not found. Please install Phantom Wallet.");
                    return;
                }
                await provider.connect();

                // Giải mã giao dịch đã mã hóa
                const transaction = solanaWeb3.Transaction.from(Buffer.from(encodedTransaction, 'base64'));

                // Yêu cầu người dùng ký giao dịch
                const signedTransaction = await provider.signTransaction(transaction);

                // Gửi giao dịch đã ký
                const connection = new solanaWeb3.Connection(solanaWeb3.clusterApiUrl('devnet'));
                const signature = await connection.sendRawTransaction(signedTransaction.serialize());
                await connection.confirmTransaction(signature);

                alert("Transaction sent successfully with signature: " + signature);
            } catch (error) {
                console.error('Error signing or sending transaction:', error);
                alert("Failed to sign or send transaction.");
            }
        }
    </script>
</body>
</html>
