<?php include 'views/partials/header.php'; ?>

<div class="container" id="orderAdminApp">

    <br>
    <h2>Мой календарь: расписание</h2>

    <div class="row">
        <div class="col-md-12" v-cloak v-if="!order">

            <div class="form-inline d-flex justify-content-end">
                <input type="date" id="searchByDateInput" class="form-control mr-1">
                <button type="button" class="btn btn-success" v-on:click="serchByDate()">Найти по дате</button>

            </div>

            <ul class="nav nav-tabs">
                <li class="nav-item ">
                    <button type="button" class="btn btn-light" v-on:click="all()">Все</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-light" v-on:click="overdue()">Просроченные</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-light" v-on:click="current()">Текущие</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-light" v-on:click="done()">Выполненные</button>
                </li>
            </ul>


            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Тема</th>
                        <th>Тип</th>
                        <th>Место</th>
                        <th>Дата начала</th>
                        <th>Дата окончания</th>
                        <th>Комментарий</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="order in orders" v-bind:class="{'text-muted': order.deleting}">
                        <td class="align-middle">{{ order.id }}</td>
                        <td><button class="btn btn-link" v-on:click="edit(order)">{{order.subject}}</button></td>
                        <td class="align-middle">{{ order.type }}</td>
                        <td class="align-middle">{{ order.place }}</td>
                        <td class="align-middle">{{ order.date_start }}</td>
                        <td class="align-middle">{{ order.date_end }}</td>
                        <td class="align-middle">{{ order.comment }}</td>
                        <td>
                            <button class="btn btn-outline-danger btn-sm" v-on:click="del(order)">удалить</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-md-6" v-if="order">
            <button class="btn btn-outline-success" v-on:click="showList">Вернуться к списку</button>
            <hr>

            <div class="alert alert-success" v-cloak v-if="message">{{ message }}</div>
            <div class="alert alert-danger" v-cloak v-if="has_errors">Обратите внимание на ошибки</div>
            <form method="POST" action="" onsubmit="return false;" v-on:submit="save">
                <?php include 'views/partials/form.php'; ?>
            </form>
        </div>
    </div>

</div>

<script type="text/javascript">
    axios.defaults.headers['X-Requested-With'] = 'XMLHttpRequest';

    new Vue({
        el: '#orderAdminApp',
        data: {
            order: null,
            orders: <?= json_encode($orders) ?>,
            types: <?= json_encode(App\Models\Order::list_types()) ?>,
            has_errors: false,
            errors: [],
            message: '',
            danger_message: '',
            sending: false
        },
        methods: {
            edit: function(order) {
                this.errors = [];
                this.has_errors = false;
                this.sending = false;
                this.message = '';
                this.danger_message = '';

                this.order = order;
            },
            del: function(order) {
                if (confirm('Delete event №' + order.id)) {
                    order.deleting = true;
                    axios.delete('/admin.php?id=' + order.id).then(response => {
                        this.orders.splice(this.orders.indexOf(order), 1);
                    }).catch(error => {
                        order.deleting = false;
                    });
                }
            },
            showList: function() {
                this.order = null;
            },
            save: function() {
                this.errors = [];
                this.has_errors = false;
                this.sending = true;

                axios.put('/admin.php?id=' + this.order.id, this.order).then(response => {
                    this.sending = false;

                    if (response.data.message) {
                        this.message = response.data.message;
                    }
                }).catch(error => {
                    this.sending = false;

                    if (error.response) {
                        this.has_errors = true;
                        this.errors = error.response.data.errors;
                    } else if (error.message) {
                        switch (error.message) {
                            case 'Network Error':
                                this.danger_message = 'Пропало соединение с сервером. Повторите отправку.';
                                break;
                            default:
                                this.danger_message = error.message;
                        }
                    }
                });
            },
            isDone: function(order) {
                if (order.comment.match(/(done)|(сделан)|(заверш)|(сдан)/iu)  )
                	return true;
                else 
                	return false;
            },
            current: function() {

                axios.get('').then(response => {

                    let now = new Date();
                    let orders = response.data.orders.filter(line => {

                        if (Date.parse(line.date_end) > now.getTime() && !this.isDone(line)) {
                            return line;
                        }
                    });

                    this.orders = orders;

                }).catch(error => {
                    console.log(error);
                    alert("Error, check console");
                })
            },
            done: function() {

                axios.get('').then(response => {

                    let orders = response.data.orders.filter(line => {
                    console.log(line.subject, this.isDone(line));  
                        if (this.isDone(line))
                            return line;
                    });

                    this.orders = orders;

                }).catch(error => {
                    console.log(error);
                    alert("Error, check console");
                })
            },
            all: function() {
                axios.get('').then(response => {
                    this.orders = response.data.orders;

                }).catch(error => {
                    console.log(error);
                    alert("Error, check console");
                })
            },
            overdue: function() {
                axios.get('').then(response => {

                    let now = new Date();
                    let orders = response.data.orders.filter(line => {
                        if (Date.parse(line.date_end) < now.getTime() && !this.isDone(line)) {
                            return line;
                        }

                    });

                    this.orders = orders;

                }).catch(error => {
                    console.log(error);
                    alert("Error, check console");
                })
            },
            serchByDate: function() {

                axios.get('').then(response => {
                    let input = document.getElementById('searchByDateInput');
                    chosen_date = new Date(input.value);
                    chosen = {
                        year: chosen_date.getFullYear(),
                        month: chosen_date.getMonth(),
                        day: chosen_date.getDate(),
                    }

                    let orders = response.data.orders.filter(function(line) {
                        let new_date = new Date(line.date_end);
                        let _new = {
                            year: new_date.getFullYear(),
                            month: new_date.getMonth(),
                            day: new_date.getDate(),
                        }
                        if (chosen.year === _new.year && chosen.month === _new.month && chosen.day === _new.day)
                            return line;
                    });

                    this.orders = orders;

                }).catch(error => {
                    console.log(error);
                    alert("Error, check console");
                })
            }

        }
    });
</script>

<?php include 'views/partials/footer.php'; ?>
