<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <div>
                    <h2>Employees</h2>
                </div>
                <div>
                    <div class="input-group mb-4 mt-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Search</span>
                        </div>
                        <input type="text" name="name" 
                        class="form-control" 
                        placeholder="Employee's name" 
                        aria-label="Employee's name" 
                        aria-describedby="button-addon2"
                        v-model="searchEmployee" @keypress.enter="filteredEmployees" @keypress.>
                        <div class="input-group-append">
                        <button class="btn btn-outline-secondary" @click="filteredEmployees">Submit</button>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Add Guest
                        </button>
                        </div>
                    </div>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Visitor</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div>
                                        <label for="name">Guest's Name</label>
                                        <input type="text" name="name" 
                                        class="form-control"
                                        :class="{'is-invalid': visitor_error.name}"
                                        placeholder="Name..." 
                                        v-model="visitor.name"
                                            required>
                                        <span v-if="visitor_error.name" class="text-danger">{{visitor_error.name[0]}}</span>
                                    </div>
                                    <div class="mt-3">
                                        <label for="department">Department</label>
                                        <select class="form-control" v-model="visitor.department" :class="{'is-invalid': visitor_error.department}">
                                            <option value="" selected disabled>Choose Department...</option>
                                            <option v-for="dept in departments" :key="dept.id" :value="dept.dept">{{dept.dept}}</option>
                                        </select>
                                        <span v-if="visitor_error.department" class="text-danger">{{visitor_error.department[0]}}</span>
                                    </div>
                                    <div class="mt-3">
                                        <label for="expiration date">Access Expiration Date</label>
                                        <input type="date" name="expiration_date" class="form-control" v-model="visitor.expDate" :class="{'is-invalid': visitor_error.expiration_date}" required>
                                        <span v-if="visitor_error.expiration_date" class="text-danger">{{visitor_error.expiration_date[0]}}</span>
                                    </div>
                                    <div class="mt-3">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary" @click="addVisitor">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div>
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Employee ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Department</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="employee in employees" :key="employee.id">
                                <th scope="row">{{employee.emp_id}}</th>
                                <td>{{employee.name}}</td>
                                <td>{{employee.dept}}</td>
                                <td>
                                    <a class="btn btn-success text btn-sm" @click="addtoPriority(employee.id)" v-if="employee.ispriority == 1">Remove Priority</a> 
                                    <a class="btn btn-success text btn-sm" @click="addtoPriority(employee.id)" v-else>Priority</a> 
                                    <a class="btn btn-danger text btn-sm" @click="addtoBlacklist(employee.id)" v-if="employee.isblacklist == 1">Remove Blacklist</a> 
                                    <a class="btn btn-danger text btn-sm" @click="addtoBlacklist(employee.id)" v-else>Blacklist</a> 
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item text-primary" 
                        :class="{disabled: prev_page_url == null}">
                            <a class="page-link" style="cursor: pointer" @click="fetchEmployees(prev_page_url)">
                                Previous
                            </a>
                        </li>
                        <li class="page-item disabled">
                            <a class="page-link">
                                Page {{current_page}} of {{last_page}}
                            </a>
                        </li>
                        <li class="page-item text-primary" 
                        :class="{disabled: next_page_url == null}">
                            <a class="page-link" style="cursor: pointer" @click="fetchEmployees(next_page_url)">
                                Next
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
import Axios from 'axios';

export default {
    data() {
        return {
            employees: {},
            next_page_url: '',
            prev_page_url: '',
            current_page: null,
            last_page: null,
            searchEmployee: '',
            departments: {},
            visitor: { name: null, department: '', expDate: null },
            visitor_error: {},
        }
    },
    mounted() {
        this.fetchEmployees();
        this.fetchDepartment();
    },
    methods: {
        fetchEmployees(page){
            let $page = (page) ? page : 'api/employees';
            Axios.get($page)
            .then(response => {
                this.employees = response.data.data;
                this.next_page_url = response.data.next_page_url;
                this.prev_page_url = response.data.prev_page_url;
                this.current_page = response.data.current_page;
                this.last_page = response.data.last_page;
            })
            .catch(error => console.log(error));
        },
        fetchDepartment(){
            Axios.get('api/departments')
            .then(response => this.departments = response.data)
            .catch(error => console.log(error));
        },
        filteredEmployees() {
            Axios.post('api/employees/search', {
                name: this.searchEmployee
            })
            .then(response => {
                this.employees = response.data.data;
                this.next_page_url = response.data.next_page_url;
                this.prev_page_url = response.data.prev_page_url;
                this.current_page = response.data.current_page;
                this.last_page = response.data.last_page;
            })
            .catch(error => console.log(error));
        },
        addVisitor() {
            Axios.post('api/add-visitor', {
                name: this.visitor.name,
                department: this.visitor.department,
                expiration_date: this.visitor.expDate,
            })
            .then(response => {
                if(response.data.success == false){
                    toastr.error(response.data.message);
                }else{
                    this.visitor_error = {};
                    this.visitor.name = null;
                    this.visitor.department = '';
                    this.visitor.expDate = null;
                    toastr.success(response.data.message);
                }
            })
            .catch(error => {
                if(error.response.status == 422){
                    this.visitor_error = error.response.data.errors;;
                }
            });
        },
        addtoPriority(id){
            Axios.post('api/employee-flag-to-priority', {
                id
            })
            .then(res => {
                if(res.data.success == false){
                    this.employees = this.employees.map(emp => (emp.id == id) ? { ...emp, ispriority: null } : emp);
                    toastr.success(res.data.message);
                }else{
                    this.employees = this.employees.map(emp => (emp.id == id) ? { ...emp, ispriority: 1, isblacklist: null } : emp);
                    toastr.success(res.data.message);
                }
            })
            .catch(err => console.log(err));
        },
        addtoBlacklist(id){
            Axios.post('api/employee-flag-to-blacklist', {
                id
            })
            .then(res => {
                if(res.data.success == false){
                    this.employees = this.employees.map(emp => (emp.id == id) ? { ...emp, isblacklist: null } : emp);
                    toastr.success(res.data.message);
                }else{
                    this.employees = this.employees.map(emp => (emp.id == id) ? { ...emp, isblacklist: 1, ispriority: null } : emp);
                    toastr.success(res.data.message);
                }
            })
            .catch(err => console.log(err));
        }
    },
}
</script>

<style scoped>
    .text {
        color: white;
    }
</style>