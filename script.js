$(document).ready(function() {
    $('.nav-link-collapse').on('click', function() {
      $('.nav-link-collapse').not(this).removeClass('nav-link-show');
      $(this).toggleClass('nav-link-show');
    });
  });

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
        }
    }
})



  
