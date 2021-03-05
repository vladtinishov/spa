function getResponse(){
    let mydata;
    axios.post('/posts/get_posts', {user_id: 1})
            .then(data => mydata = data.data).then(()=>{return mydata});
}


let app = new Vue({
    el: '#app',
    data: {
        message: 'message',
        posts: [],
    },
    methods: {
        getResponse(){
            this.posts = getResponse;
        },
        getData(){
            console.log(this.posts())
        }
    }
})