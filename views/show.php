<?php include 'views/partials/header.php'; ?>

<div class="container" id="orderApp">
    
    <h1>Мой календарь: создание записи</h1>

    <div class="row">
        <div class="col-md-6">
            <div class="alert alert-success" v-cloak v-if="message">{{ message }}</div>
            <div class="alert alert-danger" v-cloak v-if="has_errors">Обратите внимание на ошибки</div>
            <form v-if="!message" method="POST" action="" onsubmit="return false;" v-on:submit="send">
            <?php include 'views/partials/form.php'; ?>
            </form>
        </div>
    </div>

</div>

<script type="text/javascript">

axios.defaults.headers['X-Requested-With'] = 'XMLHttpRequest';

new Vue({
    el: '#orderApp',
    data: {
        order : {
            subject: '',
            type: '',
            place: '',
            date_start: '',
            date_end: '',
            comment: '',
        },
        types: <?= json_encode($order::list_types()) ?>,
        has_errors: false,
        errors: [],
        message: '',
        danger_message: '',
        sending: false
    },
    methods: {
        send: function() {
            this.errors = [];
            this.has_errors = false;
            this.sending = true;
            this.danger_message = '';

            axios.post('/', this.order).then(response => {
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