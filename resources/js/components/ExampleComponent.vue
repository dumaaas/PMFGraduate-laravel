<template>
<div>
        <li v-for="name in names" :key="name" v-text="name"></li>
        <input type="text" v-model="newName">
        <button :class="{'is-loading' : isLoading}" @click="addName">Add name</button>
        <h2>Incompleted tasks</h2>
        <ul>
            <li v-for="task in incompleteTasks" :key="task" v-text="task.description"></li>
        </ul>
        <h2>Completed tasks</h2>
        <ul>
            <li v-for="task in completedTasks" :key="task" v-text="task.description"></li>
        </ul>
        <h2>All tasks</h2>
        <ul>
            <li v-for="task in tasks" :key="task" v-text="task.description"></li>
        </ul>
    </div>
</template>

<script>
        export default {
            data() {
                return {
                    newName: '',
                    isLoading: false,
                    names: ['Marko', 'Stefan', 'Milos'],
                    tasks: [
                        {description: "Uradi nesto", completed:true},
                        {description: "Jadan nesto", completed:false},
                        {description: "Kukavce nesto", completed:true},
                        {description: "Crni nesto", completed:false}
                    ]
                }
            },
            computed: {
                incompleteTasks() {
                    return this.tasks.filter(task=>!task.completed);
                },
                completedTasks() {
                    return this.tasks.filter(task=>task.completed);
                }
            }, 
            methods: {
                addName() {
                    this.names.push(this.newName);
                    this.newName = '';
                    this.isLoading = true;
                }
            }
        }
</script>