<template>
    <div id="right">
        <h1>Development Crm</h1>

        <div class="harizontal">
            <img src="../images/horizontal.png" />
        </div>

        <p>
            lorem ipsum dolor sit am lorem lorem ipsum dolor sit am lorem lorem
            ipsum dolor sit am lorem ipsum dolor sit am lorem lorem ipsum dolor
            sit am lorem lorem ipsum dolor setInnerBailoutReason lorem ipsum
            dolor sit am lorem ipsum dolor
        </p>
        <div class="task">
            <div class="add-task">
                <h2>Today's Task</h2>
                <div class="add-action">
                    <img src="../images/add.png" />
                </div>
            </div>
            <ul class="tasks-list"></ul>
        </div>
        <div class="upcoming">
            <div class="add-tasks">
                <h2>Upcoming</h2>
                <div class="add-action">
                    <img src="../images/add.png" />
                </div>
            </div>
            <form action="" @submit="addUpcomingTask">
                <input type="text" v-model="newTask" />
            </form>
            <ul class="tasks-list">
                <li v-for="upcomingtask in upcoming" :key="upcomingtask.id">
                    <div class="info">
                        <div class="left">
                            <lable class="myCheckbox">
                                <input
                                    type="checkbox"
                                    name="test"
                                    :checked="upcomingtask.completed"
                                    @change="checkUpcoming(upcomingtask.taskId)"
                                />
                                <span></span>
                            </lable>
                            <h4>{{ upcomingtask.title }}</h4>
                        </div>
                        <div class="right">
                            <img src="../images/edit.png" />
                            <img
                                src="../images/del.png"
                                @click="delUpcoming(upcomingtask.taskId)"
                            />
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { data } from "browserslist";

export default {
    data() {
        return {
            todayTask: [],
            upcoming: [],
            newTask: "",
        };
    },
    created() {
        this.fetchTodayTask();
        this.fetchUpcoming();
    },
    methods: {
        fetchUpcoming() {
            fetch("/api/upcoming")
                .then((response) => response.json())
                .then(({ data }) => {
                    this.upcoming = data;
                })
                .catch((error) => console.log(error));
        },
        addUpcomingTask(e) {
            e.preventDefault();
            console.log(this.newTask);
            if (this.upcoming.length > 6) {
                alert("Please complete the upcoming task.");
            } else {
                const newTask = {
                    title: this.newTask,
                    waiting: true,
                    taskId: Math.random().toString(36).substring(7),
                }

                fetch("/api/upcoming", {
                    method: "post",
                    header: {
                        "content-type": "application/json",
                    },
                    body: JSON.stringify(newTask),
                }).then((response) => this.upcoming.push(newTask));

            }
        },
        delUpcoming(taskId) {
            if (confirm("are you sure?")) {
                fetch(`/api/upcoming/${taskId}`, {
                    method: "delete",
                })
                    .then((res) => res.json())
                    .then(() => {
                        this.upcoming = this.upcoming.filter(
                            ({ taskId: id }) => id !== taskId
                        );
                    });
            }
        },
        checkUpcoming(taskId) {
            if (this.todayTask.length > 4) {
                alert("Please complete exisiting task");
                window.location.href = "/";
            } else {
                addDailytask(taskId);
                fetch(`/api/upcoming/${taskId}`, {
                    method: "delete",
                })
                    .then((res) => res.json())
                    .then(() => {
                        this.upcoming = this.upcoming.filter(
                            ({ taskId: id }) => id !== taskId
                        );
                    });
            }
        },
        fetchTodayTask() {},
        addDailytask(taskId) {
            const task = this.upcoming.filter(({taskId: id }) => id == task)[0];
        },
    },
};
</script>

<style></style>
