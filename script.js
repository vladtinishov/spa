let app = new Vue({
    el: '#app',
    
    data:{
        posts_data: [],
        form: {
            form_show: false,
            form_getter: true,
            incorrect_data: false,
        },
        user_data: {
            user_name: '',
            user_id: '',
        },
        posts_data: {
            show_single_post: false,
            posts_show: false,
            posts: '',
            posts_likes: '',
            single_post: [],
        }
    },
    methods:{
        getData: function(){
            console.group('Данные из таблицы Posts')
            console.table(this.posts_data);
            console.groupEnd();
        },

        getSignUpForm: function(){
            this.form.form_show = true;
        },

        sendAutorizationData: function(){
            data = {login: document.getElementById('login').value, 
                    password: document.getElementById('password').value}
            axios.post('/users/getusers', data)
              .then(response => {
                    if(response.data != null){

                        console.group('Ответ из сервера на запрос о пользователе по введённым данным');
                        console.table(response.data);
                        console.groupEnd();

                        this.user_data.user_name = response.data.user_name;
                        this.user_data.user_id = response.data.user_id;
                        this.form.form_show = false;
                        this.form.form_getter = false;

                        this.posts_data.posts_show = true;

                        axios.post('/posts/get_posts', {'user_id':response.data.user_id})
                        .then(posts => {
                            console.group('Все посты этого пользователя');
                            console.table(posts.data);
                            console.groupEnd();

                            this.posts_data.posts = posts.data;
                        });
                        axios.post('/posts/get_likes', {'user_id':response.data.user_id})
                            .then(data => {this.posts_data.posts_likes = 
                                data.data; 
                            });
                    }
                    else{
                        console.group('Ответ из сервера на запрос о пользователе по введённым данным');
                        console.table('Введённые данные некоректны');
                        console.groupEnd();
                        this.form.incorrect_data = true;
                    }
                  } 
              )
        },

        setPosts: function(){

            axios.post('/posts/set_posts', 
                        {'user_id': this.user_data.user_id, 
                        'content': document.getElementById('createText').value
                        })
            .then(data => {
                axios.post('/posts/get_posts', {'user_id':this.user_data.user_id})
                        .then(posts => {
                            this.posts_data.posts = posts.data;
                        });
            })
        },

        setLikes: function(post_id){
            axios.post('/posts/set_like',{
                'user_id':this.user_data.user_id,
                'post_id':post_id
            }).then(() =>{
                axios.post('/posts/get_likes', {'user_id':this.user_data.user_id})
                        .then(posts => {
                            this.posts_data.posts_likes = posts.data;
                        })
                })
                .then(data => {
                    axios.post('/posts/get_posts', {'user_id':this.user_data.user_id})
                            .then(posts => {
                                this.posts_data.posts = posts.data;
                            });
                });
        },
        
        deleteLikes: function(post_id){
            axios.post('/posts/delete_like',{
                'user_id':this.user_data.user_id,
                'post_id':post_id
            }).then(() =>{
                axios.post('/posts/get_likes', {'user_id':this.user_data.user_id})
                        .then(posts => {
                            this.posts_data.posts_likes = posts.data;
                        })
                }
            )
            .then(data => {
                axios.post('/posts/get_posts', {'user_id':this.user_data.user_id})
                        .then(posts => {
                            this.posts_data.posts = posts.data;
                        });
            })
            
        },

        getSinglePost: function(post_id){
            this.posts_data.posts_show = false;
            this.posts_data.show_single_post = true;

            axios.get('/posts/get_single_post', {params: {'post_id': post_id}})
            .then(data => {
                this.posts_data.single_post = data.data;
            });
        },

        setComment: function(post_id){
            text = document.getElementById("createComment").value;
            axios.post('/posts/set_comment', {
                                            'text': text, 
                                            'post_id': post_id, 
                                            'user_id': this.user_data.user_id
                                        })
            .then(
                axios.get('/posts/get_single_post', {params: {'post_id': post_id}})
                .then(data => {
                    this.posts_data.single_post = data.data;
                })
            );
        },

        closeSinglePost: function(){
            this.posts_data.posts_show = true;
            this.posts_data.show_single_post = false;
        }
        
    }
})



  
