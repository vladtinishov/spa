let app = new Vue({
    el: '#app',
    
    data:{
        posts_data: [],
        welcome: 'd',
        form: {
            form_show: false,
            form_getter: true,
            incorrect_data: false,
        },
        user_data: {
            user_name: '',
        }
    },
    mounted(){
        this.posts_data = axios.get('/posts/getPosts')
            .then(response => this.posts_data = response.data);
    },
    methods:{
        getData: function(){
            console.group('Данные из таблицы Posts')
            console.table(this.posts_data);
            console.groupEnd();

            this.welcome = this.posts_data[0].post_id
        },

        getSignUpForm: function(){
            this.form.form_show = true;
        },
        sendAutorizationData: function(){
            data = {login: document.getElementById('login').value, 
                    password: document.getElementById('password').value}
            axios.post('/users/getusers', data)
              .then(response => {
                    if(response.data != ''){
                        console.group('Ответ из сервера на запрос о пользователе по введённым данным');
                        console.table(response.data);
                        console.log(response.data[0].user_name)
                        console.groupEnd();
                        this.user_data.user_name = response.data[0].user_name;
                        this.form.form_show = false;
                        this.form.form_getter = false;
                    }
                    else{
                        console.group('Ответ из сервера на запрос о пользователе по введённым данным');
                        console.table('Введённые данные некоректны');
                        console.groupEnd();
                        this.form.incorrect_data = true;
                    }
                  } 
              );
        },
        
    }
})



  
