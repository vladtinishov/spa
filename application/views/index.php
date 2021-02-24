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

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">BLOG)</a>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <span class="nav-link" v-if="form.form_getter" @click="getSignUpForm">Войти</span>
                <span class="nav-link" v-else >{{user_data.user_name}}</span>
            </li>
            <li class="nav-item">
                <span class="nav-link">Подписчики</span>
            </li>
        </ul>
        <form class="form-inline" action="/action_page.php">
        <input class="form-control mr-sm-2" type="text" placeholder="Search">
        <button class="btn btn-success" type="submit">Search</button>
        </form>
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

    <div v-show="posts_data.posts_show" class="container postsShow">
        <div class="createPost">
            Добавить запись<br>
            <input id="createText" width="100%" type="text" class="postTextInput form-control" placeholder="Текст">
            <br>
            <button @click="setPosts" class="btn btn-primary">Создать запись</button>
        </div>
        <div class="post" v-for="post in posts_data.posts">
            <span class="badge badge-secondary">{{post.user_name}} | {{post.post_date}}</span>
            <p>{{post.content}}</p>
            <span v-if="posts_data.posts_likes.includes(post.post_id)">Понравилось</span>
            <span v-else>Уже не понравилось</span>
        </div>
    </div>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>  
    <script type='text/javascript'><?php require_once('script.js');?></script>
</body>
</html>