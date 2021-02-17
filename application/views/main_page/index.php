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
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <ul class="navbar-nav">
            <li class="nav-item active">
            <a class="nav-link" href="#"><b>Главная</b></a>
            </li>
        </ul>
    </nav>
    <div class="container-fluid" id='app'>
        <div class="row">
            <table class="table table-striped table-hover">
                <thead class='thead-light'>
                    <tr>
                        <th>Номер</th>
                        <th>Имя</th>
                        <th>Фамилия</th>
                        <th>Дата рожд.</th>
                        <th>Удалить</th>
                        <th>Редактировать</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for='patient in mess[0]'>
                        <td>1</td>
                        <td>{{patient[1]}}</td>
                        <td>{{patient[2]}}</td>
                        <td>{{patient[3]}}</td>
                        <td>
                            <i v-on:click='del(patient[0])' class="fa fa-minus-circle" aria-hidden="true"></i>
                        </td>
                        <td>
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </td>
                    </tr>
                </tbody>
            </table>
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
    m = d;
    m = m[0];
    let app = new Vue({
        el: '#app',
        data: {
            mess: d,
        },
        methods:{
            del: function (link){
                axios.get('/patients/delete?id='+link)
                    .then(function(response){ d.push(response['data']) })
                    .catch((error) => console.log(error.response.data));
                console.log(d);
            }
        }
    });
    </script>
</body>
</html>