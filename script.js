let app = new Vue({
    el: '#app',
    data:{
        posts_data: [],
    },
    mounted(){
        axios.get('/posts/getPosts')
            .then(function (response) {
                console.group('Запрос данных о постах');
                console.table(response.data);
                console.groupEnd()
        })
    },
    methods:{
        thisCheck: function(){
            
        }
    }
})



  