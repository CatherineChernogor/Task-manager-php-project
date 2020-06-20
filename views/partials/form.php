
<div class="form-group mb-3" v-bind:class="{'has-error': !!errors.subject}">
    <label>Тема:</label>
    <input class="form-control h-50 mt-n2" type="text" v-model="order.subject">
    <span class="text-danger text-sm-left" v-cloak v-if="errors.subject">{{ errors.subject }}</span>
</div>

<div class="form-group mb-3" v-bind:class="{'has-error': !!errors.type}">
    <label>Тип:</label>
    <select class="form-control h-50 mt-n2" v-model="order.type">
        <option v-for="type in types" v-bind:value="type">{{ type }}</option>
    </select>
    <span class="text-danger text-sm-left" v-cloak v-if="errors.type">{{ errors.type }}</span>
</div>

<div class="form-group mb-3">
    <label>Место:</label>
    <input class="form-control h-50 mt-n2" type="text" v-model="order.place">
</div>

<div class="form-group mb-3" v-bind:class="{'has-error': !!errors.date_start}">
    <label>Дата начала:</label>
    <input class="form-control h-50 mt-n2" type="datetime-local" v-model="order.date_start">
    <span class="text-danger text-sm-left" v-cloak v-if="errors.date_start">{{ errors.date_start }}</span>
</div>

<div class="form-group mb-3" v-bind:class="{'has-error': !!errors.date_end}">
    <label>Дата конца:</label>
    <input class="form-control h-50 mt-n2" type="datetime-local" v-model="order.date_end">
    <span class="text-danger text-sm-left" v-cloak v-if="errors.date_end">{{ errors.date_end }}</span>
</div>

<div class="form-group mb-3">
    <label>Комментарий:</label>
    <input class="form-control h-50 mt-n2" type="text" v-model="order.comment">
</div>

<div class="form-group mb-3">
    <button class="btn btn-primary" type="submit" v-bind:disabled="sending">Отправить</button>
    <span class="text-info" v-cloak v-if="sending">Отправляю...</span>
    <span class="text-danger text-sm-left" v-cloak v-if="danger_message">{{ danger_message }}</span>

</div>
