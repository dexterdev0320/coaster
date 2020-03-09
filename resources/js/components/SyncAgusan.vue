<template>
    <div>
        <li class="nav-item">
            <a class="nav-link" href="#" style="color: black;" data-toggle="modal" data-target="#exampleModal" @click="syncDavao">
                Sync Agusan
            </a>
        </li>
        <!-- Modal -->
        <div v-if="modal === true" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Sync Agusan Employees</h4>
                    </div>
                    <div class="modal-body">
                        <CubeShadow v-if="loading === true" style="width: 200px; height: 200px; margin: 0 auto;" class=""></CubeShadow>
                        <div v-else>
                            <h1 v-bind:class="[sync_response.success === false ? 'text-danger' : 'text-success']">{{ message }}</h1>
                            <h5 v-if="sync_response.success" class="text-info"> You will be redirected to employees list!</h5>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center" v-if="loading === false">
                        <a href="employees" class="btn btn-primary btn-sm">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</template>

<script>
import Axios from 'axios';
import {CubeShadow} from 'vue-loading-spinner'

export default {
    data() {
        return {
            modal: false,
            loading: false,
            message: '',
            sync_response: {},
        }
    },
    components: {
        CubeShadow
    },
    methods: {
        syncDavao(){
            this.modal = true;
            this.loading = true;
            Axios.post('api/sync/agusan')
                .then(res => this.sync_response = res.data)
                .then(res =>{
                    if(res.success === false){
                        this.loading = false;
                        this.message = res.message;
                    }else{
                        this.loading = false;
                        this.message = this.sync_response.message;
                    }
                })
        }
    }
}
</script>
