let app = new Vue({
    el: '#app',
    
    data:{
        posts_data: [],
        welcome: 'd',
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

        signIn: function(){
            data = {login: 'admin', password: 'password'}
            axios.post('../users/getusers', JSON.stringify(data))
              .then(response => console.table(response.data)
              );
        },
    }
})



  
