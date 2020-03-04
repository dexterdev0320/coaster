<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Destination</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div data-spy="scroll" data-target="#navbar-example2" data-offset="0">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Destination</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="dest in destinations" :key="dest.id">
                                <td>
                                    <input type="text" v-if="dest.id == selected" v-model="dest_value" class="form-control" placeholder="Type the new Destination here...">
                                    <span v-if="editDestinationError.destination && dest.id == selected" class="text-danger">{{ editDestinationError.destination[0] }}</span>
                                    <label for="place" v-bind="{hidden: dest.id == selected}">{{ dest.place }}</label>
                                </td>
                                <td>
                                    <button v-if="dest.id != selected" class="btn btn-primary btn-sm" @click="editDestination(dest.id, dest.place); editDestinationError = []">Edit</button>
                                    <button v-if="btn_save == true && dest.id == selected" class="btn btn-secondary btn-sm" @click="btn_save = false; selected = undefined; editDestinationError = []">Cancel</button> 
                                    <button v-if="btn_save == true && dest.id == selected" class="btn btn-success btn-sm" @click="saveDestination(dest.id, dest_value)">Save</button> 
                                    <button class="btn btn-danger btn-sm" @click="deleteDestination(dest.id)">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Create Destination</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" name="place" class="form-control" :class="{'is-invalid': destination_error.destination }" placeholder="Type Destination here..." v-model="new_dest">
                            <span v-if="destination_error.destination" class="text-danger">{{destination_error.destination[0]}}</span>
                        </div>
                        <button type="submit" class="btn btn-primary" @click="addDestination(new_dest)">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Axios from 'axios';

export default {
    mounted() {
        this.fetchDestinationAPI();
    },
    data() {
        return {
            destinations: [],
            new_dest: '',
            dest_value: '',
            selected: undefined,
            btn_save: false,
            destination_error: [],
            editDestinationError: [],
        }
    },
    methods: {
        fetchDestinationAPI(){
            Axios.get('api/destinations')
                .then(res => this.destinations = res.data.data)
                .catch(err => console.log(err))
        },
        addDestination(destination){
            Axios.post('api/destination', {
                destination: this.new_dest
            })
                .then(res => {
                    this.destination_error = [];
                    if(res.data.success == false){
                        toastr.error(res.data.message);
                    }else{
                        this.fetchDestinationAPI();
                        toastr.success(res.data.message);
                        this.new_dest = '';
                    }
                })
                .catch(error => {
                    if(error.response.status == 422){
                        this.destination_error = error.response.data.errors;
                    }
                })
        },
        isConfirm(success){
            if(success){
                this.fetchDestinationAPI();
            }else{
                swal("Cancelled", "Your imaginary file is safe :)", "error");
            }
        },
        deleteDestination(id){
            let _this = this;
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: false,
                closeOnCancel: false
                },
                function(isConfirm) {
                if (isConfirm) {
                      Axios.delete('api/destination/' + id)
                    .then(res => {
                        if(res.data.success == false){
                            swal("Error!", res.data.message, "error");
                        }else{
                            swal("Deleted!", res.data.message, "success");  
                            _this.fetchDestinationAPI();
                        }
                    })
                    .catch(err => console.log(err))
                } else {
                    swal("Cancelled", "Destination remain", "error");
                }
                });
        },
        editDestination(id, place){
            this.selected = id;
            this.dest_value = place;
            this.btn_save = true;
        },
        saveDestination(id, place){
            Axios.put('api/destination/' + id,{
            id: id,
            destination: place
            })
            .then(res => {
                if(res.data.success == false){
                    toastr.error(res.data.message)
                }else{
                    this.selected = undefined;
                    this.btn_save = false;
                    this.fetchDestinationAPI();
                    toastr.success(res.data.message)
                }
            })
            .catch(err => {
                if(err.response.status == 422){
                    this.editDestinationError = err.response.data.errors;
                }
            });
        }
    }
}
</script>