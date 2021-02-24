<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>BLOG)</title>
</head>
<body>
<style><?php require_once('style.css')?></style>

    <div id="app">

    <input type="checkbox" id="nav-toggle" hidden>
    <nav class="nav">
        <label for="nav-toggle" class="nav-toggle" onclick></label>
        <h2 class="logo"> 
            <a href="#">BLOG)</a> 
        </h2>
        <ul>
            <li v-if="form.form_getter" @click="getSignUpForm">Войти</li>
            <li v-else @click="getSignUpForm">{{user_data.user_name}}</li>
            <li>Подписчики</li>
            <li>Лента</li>
        </ul>
    </nav>

    <div v-show="form.form_show" class="signUpForm">
        <h3>Форма входа</h3>
        <form>
            <div class="form-group">
                <label for="login">Логин</label>
                <input type="text" class="form-control" id="login" placeholder="логин">
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" class="form-control" id="password" placeholder="Пароль">
            </div>
            <p @click="sendAutorizationData" class="btn btn-primary">Ввести</p>
            <p>Не зарегистрированы? Зарегистрироваться</p>
            <p v-show="form.incorrect_data" style="color: red">Некоректные данные</p>
        </form>
    </div>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>  
    <script type='text/javascript'><?php require_once('script.js');?></script>
</body>
</html>