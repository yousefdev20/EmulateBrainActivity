<template>
    <div class="px-5 card my-5 border-0 shadow-sm position-static">
        <div>
            <div class="float-right">
                show

                <select @change="load" class="form-control">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="75">75</option>
                </select>
            </div>
            <h4 class="text-wight my-3">
                <br/>
                <input class="form-control col-sm-5 col-lg-3" placeholder="search" autofocus @input="search" style="position: inherit"/>
            </h4>
        </div>
        <div class="table table-responsive">
            <table class="table table-md table-hover">
                <thead v-if="schema != null">
                    <th>
                        #
                    </th>
                    <th v-for="(index, key) in JSON.parse(schema)" :key="key+'schema'">
                        <b :id="index" @click="sort">{{ index }} <span class="fae fa-sort-alt"></span></b>
                    </th>
                <th>
                    actions
                    <i class="text-danger fas fa-sort-alt"></i>
                </th>
                </thead>
                <tbody v-if="data.length > 0">
                    <tr v-for="(index, key) in A_data" :key="key">
                        <td>
                            <b>#{{ key }}</b>
                        </td>
                        <td v-for="(indexOfItem, keyofitem) in index" :key="keyofitem+'keyofitem'">
                            <u class="text-primary" v-if="indexOfItem == null">
                                غير متوفر
                            </u>
                            <b v-else>
                                {{ indexOfItem }}
                            </b>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary" :id="key" :data_id="index.id" @click="view" v-if="permission.includes('browse_'+object_type)">browse</button>
                            <button class="btn btn-sm btn-warning" :id="key" :data_id="index.id" v-on:click="edit" v-if="permission.includes('edit_'+object_type)">edit</button>
                            <button class="btn btn-sm btn-danger" :id="key" :data_id="index.id" v-on:click="Delete" v-if="permission.includes('delete_'+object_type)">delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: 'reader',
    data(){
        return{
            type: null,
            loading: true,
            row: 10,
            searchBarContent: '',
            url: String,
            A_data: {
                type: Array,
                require: true
            },
            full_data: {
                type: Array,
                require: true
            }
        }
    },
    created(){
        this.init();
    },
    props:{
        schema: {
            type: String,
            require: true
        },
        data: {
            type: String,
            require: true
        },
        permission: {
            type: String,
            require: true
        },
        uri: String,
        object_type: String

    },
    methods:{
        Delete(e){
            if (window.confirm("are you sure?")) {
                axios.get(this.url + '/delete/' + e.target.getAttribute('data_id'))
                    .then((response) => {
                        console.log(e.target.id);
                        this.A_data.splice(e.target.id, 1);
                    }).catch((error) => {
                    console.error(error)
                }).finally(() => {
                    console.log("has been seccess delete an object");
                })
            }
        },
        view(e){
            window.location.href = this.url+'/'+e.target.getAttribute('data_id')
        },
        edit(e){
            window.location.href = this.url+'/edit/'+e.target.getAttribute('data_id')
            // axios.get(this.url+'/edit/'+e.target.getAttribute('data_id'))
            //     .then((response)=>{
            //     }).catch((error) => {
            //     console.error(error)
            // }).finally(()=>{
            //     console.log("edit object");
            // })
        },
        create(){
            axios.get(this.uri+'/create')
            .then((response)=>{
                this.init();
            }).catch((error)=>{
                console.error(error)
            })
        },
        load(e){
            this.row = parseInt(e.target.value);
            console.log(this.full_data.length/this.row);
            console.log('Count'+this.full_data.length);
            this.A_data = this.full_data.slice(0,this.row);
        },
        currentPage(e){
            console.log("hi[] ms yousef are you good sound good");

        },
        search(e){
            this.A_data = [];
            this.full_data.map((el) => {
                let concat = ''
                for (var i = 0; i < Object.keys(el).length ;i++){
                    concat += (el[Object.keys(el)[i]]);
                }
                if (concat.toString().toUpperCase().includes(e.target.value.toString().toUpperCase())) {
                    this.A_data.push(el);
                    this.A_data = this.A_data.slice(0, this.row);
                }
            })
        },
        sort(e){
            this.A_data = this.A_data.sort(function (a, b){
                if (a[e.target.id] < b[e.target.id]) {
                    return -1;
                }
                if (a[e.target.id] > b[e.target.id]) {
                    return 1;
                }
                return 0;
            });
        },
        init(){
            console.log("init")
            console.log(this.uri)
            this.url = (this.uri);
            this.full_data = JSON.parse(this.data);
            this.A_data = this.full_data.slice(0,this.row);
            this.loading = false;
            console.log(this.full_data.length/this.row);
        }
    },
    computed: {
        filteredList(e) {
            this.A_data.filter(el => {
                console.log(el.name.toLowerCase().includes('yousef'))
            })
        }
    }

}
</script>

<style scoped>

</style>
