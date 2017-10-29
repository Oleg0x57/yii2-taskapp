<div id="taskApp">
    <input v-model="newTask" v-on:keyup.enter="addTask"/>
    <ol>
        <li v-for="todo in todos">
            {{ todo.title }}
        </li>
    </ol>
</div>

<?php
$this->registerJsFile('https://unpkg.com/vue');
$this->registerJs(<<<JS
var apiUrl = "http://yiitask.dev/api/task/";
var TaskApp = new Vue({
    el: "#taskApp",
    mounted: function () {
        this.\$nextTick(function () {
            this.fetchTasks();
      })
    },
    data: {
        todos: [],
        newTask: null
    },
    methods: {
        fetchTasks: function(){
            var self = this;
            $.get({url: apiUrl}).success(function(res){
               self.todos = res;
            });
        },
        addTask: function(){
            var self = this;
            $.post({
                url: apiUrl + 'create',
                data: {
                    title: this.newTask
                },
                done: function(response){console.log(response)},
                success: function(){
                    self.fetchTasks();
                }
            });
            this.newTask = null;
        }
    }
});
JS
);
?>