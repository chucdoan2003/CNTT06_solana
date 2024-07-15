<!DOCTYPE html>
<html>
<head>
    <title>Create NFT Collection</title>
</head>
<body>
    <h1>Create NFT Collection</h1>
    <form action="/create-collection" method="POST">
        @csrf
        <label for="collection_name">Collection Name:</label><br>
        <input type="text" id="collection_name" name="collection_name" ><br><br>
        
        <label for="symbol">Symbol:</label><br>
        <input type="text" id="symbol" name="symbol" ><br><br>
        
        <label for="description">Description:</label><br>
        <textarea id="description" name="description" ></textarea><br><br>
        
        <input type="submit" value="Create Collection">
    </form>
</body>
</html>
