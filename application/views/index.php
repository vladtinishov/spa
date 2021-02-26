<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>BLOG)</title>
</head>
<body>
<style><?php require_once('style.css')?></style>

    <div id="app">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">BLOG)</a>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <span class="nav-link" v-if="!this.form.form_show" >{{user_data.user_name}}</span>
            </li>
            <li class="nav-item">
                <span class="nav-link"><i class="fa fa-user-o" aria-hidden="true"></i>
                 {{user_data.followers_count}}</span>
            </li>
        </ul>
        <form v-show="posts_data.posts_show" class="form-inline">
        <input id="searched_user_name" class="form-control mr-sm-2" type="text" placeholder="Введите имя">
        <span @click="getSearchedUsers" class="btn btn-primary">Искать</span>
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
            <p v-show="form.incorrect_data" style="color: red">Некоректные данные</p>
        </form>
        <p>Не зарегистрированы?</p>
        <form>
            <h3>Форма регистрация</h3>
            <div class="form-group">
                <label for="reg_name">Имя</label>
                <input type="text" class="form-control" id="reg_name" placeholder="Имя">
            </div>
            <div class="form-group">
                <label for="reg_login">Логин</label>
                <input type="text" class="form-control" id="reg_login" placeholder="Логин">
            </div>
            <div class="form-group">
                <label for="reg_password">Пароль</label>
                <input type="text" class="form-control" id="reg_password" placeholder="Пароль">
            </div>
            <div class="form-group">
                <label for="reg_password_again">Пароль</label>
                <input type="text" class="form-control" id="reg_password_again" placeholder="Пароль ещё раз">
            </div>
            <p @click="sendRegistrationData" class="btn btn-primary">Ввести</p>
            <p v-show="form.reg_incorrect_data" style="color: red">Неверные данные</p>
            <p v-show="form.okey">Регистрация прошла успешно</p>
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
            <span 
                @click="deleteLikes(post.post_id)" 
                v-if="posts_data.posts_likes.includes(post.post_id)"
                style="color: red"><i class="fa fa-heart" aria-hidden="true"></i></span>
            <span @click="setLikes(post.post_id)" v-else style="color: gray">
                <i class="fa fa-heart" aria-hidden="true"></i>
            </span>
            <span>{{post.likes}}</span><br>
            <span @click="getSinglePost(post.post_id)">Развернуть</span>
        </div>
    </div>

    <div v-show="posts_data.show_single_post" class="container single_post">
        <span @click="closeSinglePost"><i class="fa fa-times" aria-hidden="true"></i></span>
        <span class="" v-for="user_data in posts_data.single_post.users_data">
            <span class="badge badge-secondary">{{user_data.user_name}}</span>
        </span> 
        <div class="" v-for="post_data in posts_data.single_post.posts_data">
            {{post_data.content}}
            <hr>
            <div class="" v-for="comment_data in posts_data.single_post.comments_data">
                <span class="badge badge-secondary">
                    {{comment_data.user_name}} прокоментировал:
                </span> {{comment_data.comment_text}}
            </div> 
            <br>
            <input id="createComment" width="100%" type="text" class="form-control" placeholder="Текст комментария">
            <br>
            <button @click="setComment(post_data.post_id)" class="btn btn-primary">Прокоментировать</button>
        </div> 
      
    </div>

    <div v-show="user_data.show_searched_data" class="searched_users container">
        <br>
        <span style="color: white" @click="closeSearchedUsers">
            <i class="fa fa-times" aria-hidden="true"></i> Закрыть</span>
        <div class="single_post" v-for="data in user_data.searched_users">
            {{data.user_name}}
            <div v-if="user_data.followers_data.includes(data.user_id)">Подписан</div>
            <div @click="setFollower(data.user_id)" v-else>Подписаться</div>
            <!-- <button @click="setFollower(data.user_id)" class="btn btn-primary">Подписаться</button> -->
        </div>
    </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>  
    <script type='text/javascript'><?php require_once('script.js');?></script>
</body>
</html>