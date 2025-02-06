@extends('layout')

@section('content')
<div id="app" class="container" v-cloak>
    <h4>Item management</h4>
    <form @submit.prevent="submitForm">
        <input type="hidden" v-model="id">
        <input type="text" v-model="title" placeholder="title...">
        <input type="text" v-model="content" placeholder="content...">
        <button type="submit">submit</button>
    </form>
    <h5 class="mt-5">Item List</h5>
    <div v-show="isLoading" class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
    <div v-if="items.length">
        <ul>
            <li v-for="item in items" :key="item.id">
                <span v-html="item.title"></span>
                <button @click="editData(item)">Edit</button>
                <button @click="deleteData(item.id)">Delete</button>
                <section v-html="item.content"></section>
            </li>
        </ul>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue@3.0.0/dist/vue.global.js"></script>
<script>
    const app = Vue.createApp({
        data(){
            return {
                items: [],
                id: "",
                title: "",
                content: "",
                isLoading: true,
            }
        },
        methods: {
            async fetchData(){
                try {
                    // /api/posts ->api.phpによれば、これはApi\PostControllerの事
                    let response = await fetch("/api/posts", {
                        methods: "GET",
                        headers: {"Content-Type": "application/json"},
                    })
                    let data = await response.json()
                    if (data) {
                        this.items = JSON.parse(JSON.stringify(data))
                    }
                } catch (error) {
                    console.log(error)
                    alert(error);
                } finally {
                    this.isLoading = false;
                }
            },
            async postData(){
                try {
                    let param = {
                        title: this.title,
                        content: this.content,
                    }
                    let response = await fetch("/api/posts", {
                        method: "POST",
                        headers: {"Content-Type": "application/json"},
                        body: JSON.stringify(param),
                    })
                    let data = await response.json()
                    if (data) {
                        // response()->json([])で送ったメッセージはresponseの返り値だからここで受け取る!!
                        alert(data.message)
                        this.init()
                        this.fetchData()
                    } else {
                        console.log("no data")
                    }
                } catch (error) {
                    console.log(error)
                } finally {
                    console.log("Connection ended!")
                }
            },
            editData(item){
                this.id = item.id
                this.title = item.title
                this.content = item.content
            },
            async updateData(id){
                let param = {
                    id: this.id,
                    title: this.title,
                    content: this.content,
                }
                await fetch(`/api/posts/${id}`, {
                    method: "PUT",
                    headers: {"Content-Type": "application/json"},
                    body: JSON.stringify(param),
                })
                .then(response => response.json())
                .then(json => {
                    alert(json.message)
                    this.init()
                    this.fetchData()
                })
                .catch(error => console.log(error))
                .finally(() =>{})
            },
            async deleteData(id){
                if (confirm("are you sure?")) {
                    let param = {
                        id: this.id,
                    }
                    await fetch(`/api/posts/${id}`, {
                        method: "DELETE",
                        headers: {"Content-Type": "application/json"},
                        body: JSON.stringify(param)
                    })
                    .then(response => response.json())
                    .then(json => {
                        alert(json.message)
                        this.fetchData()
                    })
                    .catch(error => console.log(error))
                    .finally(() => {})
                }
            },
            submitForm(){
                if (this.id == "") {
                    this.postData();
                } else {
                    this.updateData(this.id);
                }
            },
            init(){
                this.id = ""
                this.title = "";
                this.content = "";
            },
        },
        mounted(){
            this.fetchData();
        }
    })
    app.mount("#app")
</script>
@endsection
