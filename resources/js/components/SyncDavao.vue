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
                        <h4>Sync Davao Employees</h4>
                    </div>
                    <div class="modal-body">
                        <CubeShadow v-if="loading === true" style="width: 200px; height: 200px; margin: 0 auto;" class=""></CubeShadow>
                        <div v-else>
                            <h1 class="text-success">{{ message }}</h1>
                            <h5 class="text-info"> You will be redirected to employees list!</h5>
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
        }
    },
    components: {
        CubeShadow
    },
    methods: {
        syncDavao(){
            this.modal = true;
            this.loading = true;
            Axios.post('api/sync/davao')
                .then(res => {
                    this.loading = false;
                    this.message = res.data.message;
                })
        }
    }
}
</script>