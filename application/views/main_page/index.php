<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Главная</title>
</head>
<body>
    <div id='app'>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <ul class="navbar-nav">
                <li v-on:click='get_ins' class="nav-item active">
                    <i class="fa fa-plus nav-link" aria-hidden="true"></i>
                </li>
            </ul>
        </nav>
        <div class='container-fluid'>

            <div class="insert" v-if='ins'>
                <form>
                <br>
                <br>
                    <div class="form-group">
                        <label for="name">Имя</label>
                        <input type="text" class="form-control" id="iname" placeholder="Введите имя">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Фамилия</label>
                        <input type="text" class="form-control" id="ilastname" placeholder="Введите фамилию">
                    </div>
                    <br><br>
                    <div v-on:click='insy' class="btn btn-primary">Применить</div><br>
                </form>
            </div>

            <div v-if='sel' class="row">
                <table class="table table-striped table-hover">
                    <thead class='thead-light'>
                        <tr>
                            <th>ID</th>
                            <th>Имя</th>
                            <th>Фамилия</th>
                            <th>Удалить</th>
                            <th>Редактировать</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for='patient in mess[0]'>
                            <td>{{patient[0]}}</td>
                            <td>{{patient[1]}}</td>
                            <td>{{patient[2]}}</td>
                            <td>
                                <i id='del' v-on:click='del(patient[0])' class="fa fa-minus-circle" aria-hidden="true"></i>
                            </td>
                            <td v-on:click='get_form(patient[0])'>
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="update" v-if='upd'>
            <br><br>
                <form>
                    <div class="form-group">
                        <label for="name">Имя</label>
                        <input type="text" class="form-control" id="name" placeholder="Введите имя">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Фамилия</label>
                        <input type="text" class="form-control" id="lastname" placeholder="Введите фамилию">
                    </div>
                    <br><br>
                    <div v-on:click='updty' class="btn btn-primary">Применить</div><br>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script>
    
    let d = new Array();
    axios.get('/patients/get')
        .then(function(response){ d.push(response['data']) })
        .catch((error) => console.log(error.response.data));
    console.log(d);
    // d = [[[0,0,0,0]]];
    arr = [];
    let app = new Vue({
        el: '#app',
        data: {
            mess: d,
            per: 'hello',
            arr: '',
            upd: false,
            sel: true,
            ins:false,
            id: 66,
            name: '',
            lastname: '',
        },
        methods:{
            del: function (link){
                axios.get('/patients/delete?id='+link)
                    .then(function(response){ 
                        axios.get('/patients/get')
                            .then(function(response){ 
                                arr = response.data;
                                console.log('hello ' + arr);
                            })
                    })
                    .catch((error) => console.log(error.response.data));
            },
            get_form: function (id){
                this.upd = !this.upd;
                this.sel = !this.sel;
                this.id = id;
            },
            updty: function (link){
                this.name = document.getElementById('name').value;
                this.lastname = document.getElementById('lastname').value;
                axios.get('/patients/put?name='+this.name+'&lastname='+this.lastname+'&id='+this.id)
                    .then(function(response){ 
                        axios.get('/patients/get')
                            .then(function(response){ 
                                arr = response.data;
                                console.log('hello ' + arr);
                            })
                    })
                    .catch((error) => console.log(error.response.data));
            },
            get_ins: function(){
                this.ins = !this.ins;
                this.sel = !this.sel;
            },
            insy: function(){
                this.name = document.getElementById('iname').value;
                this.lastname = document.getElementById('ilastname').value;
                axios.get('/patients/post?name='+this.name+'&lastname='+this.lastname+'&id='+this.id)
                    .then(function(response){ 
                        axios.get('/patients/get')
                            .then(function(response){ 
                                arr = response.data;
                                console.log( arr);
                            })
                    })
                    .catch((error) => console.log(error.response.data));
                    
            }
        },
        
        computed:{
            de: function (){
                return d;
            },
            hello: function(){
                return 
            },
        }
    });
    </script>
</body>
</html>