<?php include 'views/partials/header.php'; ?>

<div class="container" id="orderAdminApp">

    <h1>Страница администратора</h1>

    <div class="row">
        <div class="col-md-12" v-cloak v-if="!order">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Subject</th>
                        <th>Type</th>
                        <th>Place</th>
                        <th>Date_start</th>
                        <th>Date_end</th>
                        <th>Comment</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="order in orders" v-bind:class="{'text-muted': order.deleting}">
                        <td>{{ order.id }}</td>
                        <td><button class="btn btn-link" v-on:click="edit(order)">{{order.subject}}</button></td>
                        <td>{{ order.type }}</td>
                        <td>{{ order.place }}</td>
                        <td>{{ order.date_start }}</td>
                        <td>{{ order.date_end }}</td>
                        <td>{{ order.comment }}</td>
                        <td>
                            <button class="btn btn-xs btn-danger" v-on:click="del(order)">delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-md-6" v-if="order">
            <button class="btn btn-default" v-on:click="showList">Вернуться к списку</button>
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
        orders: <?= json_encode($orders)?>,
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
            if (confirm('Delete event №' + order.id)){
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

                if (response.data.message)
                {
                    this.message = response.data.message;
                }
            }).catch(error => {
                this.sending = false;

                if (error.response)
                {
                    this.has_errors = true;
                    this.errors = error.response.data.errors;
                }
                else if (error.message)
                {
                    switch (error.message)
                    {
                        case 'Network Error':
                            this.danger_message = 'Пропало соединение с сервером. Повторите отправку.';
                            break;
                        default:
                            this.danger_message = error.message;
                    }
                }
            });
        }
    }
});
</script>

<?php include 'views/partials/footer.php'; ?>