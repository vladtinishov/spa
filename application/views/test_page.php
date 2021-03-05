<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Test area:</h1>

    <div id="app">
        
        <button @click="getResponse">{{message}}</button>
        <button @click="getData">CLick</button>
        <!-- <button @click='getUsers'>get</button> -->

    </div>


<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>  
<script><?php require_once('scripts/main.js')?></script>

</body>
</html>
