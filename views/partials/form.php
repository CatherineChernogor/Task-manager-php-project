
<div class="form-group" v-bind:class="{'has-error': !!errors.subject}">
    <label>Тема:</label>
    <input class="form-control" type="text" v-model="order.subject">
    <span class="help-block" v-cloak v-if="errors.subject">{{ errors.subject }}</span>
</div>

<div class="form-group" v-bind:class="{'has-error': !!errors.type}">
    <label>Тип:</label>
    <select class="form-control" v-model="order.type">
        <option v-for="type in types" v-bind:value="type">{{ type }}</option>
    </select>
    <span class="help-block" v-cloak v-if="errors.type">{{ errors.type }}</span>
</div>

<div class="form-group">
    <label>Место:</label>
    <input class="form-control" type="text" v-model="order.place">
</div>

<div class="form-group" v-bind:class="{'has-error': !!errors.date_start}">
    <label>Дата начала:</label>
    <input class="form-control" type="datetime-local" v-model="order.date_start">
    <span class="help-block" v-cloak v-if="errors.date_start">{{ errors.date_start }}</span>
</div>

<div class="form-group" v-bind:class="{'has-error': !!errors.date_end}">
    <label>Дата конца:</label>
    <input class="form-control" type="datetime-local" v-model="order.date_end">
    <span class="help-block" v-cloak v-if="errors.date_end">{{ errors.date_end }}</span>
</div>

<div class="form-group">
    <label>Комментарийй:</label>
    <input class="form-control" type="text" v-model="order.comment">
</div>

<div class="form-group">
    <button class="btn btn-primary" type="submit" v-bind:disabled="sending">Отправить</button>
    <span class="text-info" v-cloak v-if="sending">Отправляю...</span>
    <span class="text-danger" v-cloak v-if="danger_message">{{ danger_message }}</span>

</div>
