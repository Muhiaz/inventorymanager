<template>
    <div class="container" mt-5>
        <button class="btn btn-success" @click="newModal()">Add Product <i class="fa fa-user-plus"></i></button>
        <!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  @submit.prevent="editmode ? updateProduct() : createProduct()" >
      <div class="modal-body">
         <div class="form-group">
      <label>Product name</label>
      <input v-model="form.name" type="text" name="name"
        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
      <has-error :form="form" field="name"></has-error>
    </div>
    <div class="form-group">
      <label>Category</label>
      <input v-model="form.category" type="text" name="category"
        class="form-control" :class="{ 'is-invalid': form.errors.has('category') }">
      <has-error :form="form" field="category"></has-error>
    </div>
     <div class="form-group">
      <label>Description</label>
      <input v-model="form.description" type="text" name="description"
        class="form-control" :class="{ 'is-invalid': form.errors.has('description') }">
      <has-error :form="form" field="description"></has-error>
    </div>
    <div class="form-group">
      <label>Quantity</label>
      <input v-model="form.quantity" type="text" name="quantity"
        class="form-control" :class="{ 'is-invalid': form.errors.has('quantity') }">
      <has-error :form="form" field="quantity"></has-error>
    </div>
    <div class="form-group">
      <label>Price</label>
      <input v-model="form.price" type="text" name="price"
        class="form-control" :class="{ 'is-invalid': form.errors.has('price') }">
      <has-error :form="form" field="price"></has-error>
    </div>
     <div class="form-group">
      <label>Supplier</label>
      <input v-model="form.supplier" type="text" name="supplier"
        class="form-control" :class="{ 'is-invalid': form.errors.has('supplier') }">
      <has-error :form="form" field="supplier"></has-error>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
    
  </div>
  
</div>
       <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="example1_length"><label>Show <select name="example1_length" aria-controls="example1" class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                  <thead>
                  <tr role="row">
                      <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Product Name</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Name</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Date Added
                        </th>
                        <th>Action</th></tr>
                  </thead>
                  <tbody>
                  <tr v-for="product in products" :key="product.id" role="row" class="odd">
                    <td>{{product.id}}</td>
                    <td>{{product.name | textUp}}</td>
                    <td>{{product.created_at | customDate}}</td>
                    <td>
                      <button @click="editModal(product)"><i class="fa fa-edit fa-w text-blue"></i></button>
                    <button @click="deleteUser(product.id)"><i class="fa fa-trash fa-w text-red"></i></button>
                    </td>
                  </tr></tbody>
                  
                </table></div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0" class="page-link">3</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0" class="page-link">4</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0" class="page-link">5</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0" class="page-link">6</a></li><li class="paginate_button page-item next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
              </div>

    </div>
</template>

<script>
    export default {
        data(){
            return {
                products:{},
                form: new Form({
                  id:'',
                    name:'',
                    category:'',
                    quantity:'',
                    description:'',
                    price:'',
                    supplier:'',
                })
            }
        },
        methods : {
          updateProduct(){
            this.form.put('api/product/'+this.form.id).then(()=>{
              swal.fire(
                'Updated!',
                'Information has been updated',
                'success'
              )
              Fire.$emit('AfterCreate');
              $("#exampleModalCenter").modal("hide");
            }).catch(()=>{
              
            });
          },
          editModal(product){
            this.editmode = true;
            this.form.reset();
            this.form.fill(product)
            $("#exampleModalCenter").modal("show");
          },
          newModal(){
            this.editmode = false;
            this.form.reset();
            $("#exampleModalCenter").modal("show");
          },
          deleteProduct(id){
            swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete product!'
          }).then((result) => {
            if (result.isConfirmed) {
              this.form.delete('api/product/'+id).then(()=>{
                swal.fire(
                'Deleted!',
                'Your product has been deleted.',
                'success'
              )
              Fire.$emit('AfterCreate');
              }).catch(()=>{
                swal.fire(
                'Failed!',
                'A problem occurred !',
                'warning'
              )
              })
              
            }
})
          },
             loadProducts(){
            axios.get('api/product').then(({data})=>(this.products = data.data));
        },
            createProduct(){
              this.$Progress.start()
                this.form.post('api/product').then(()=>{
                  Fire.$emit('AfterCreate');
                Toast.fire({
                icon: 'success',
                title: 'Product Added successfully'
})
                
                $('#exampleModalCenter').modal('hide');
                this.$Progress.finish()
                }).catch(()=>{
 swal.fire(
                'Failed!',
                'The supplier is not in your database !',
                'warning'
              )
                })
                
            }
        },
       
        created() {
            this.loadProducts();
            Fire.$on('AfterCreate',() => {
              this.loadProducts();
            });
            // setInterval(()=>this.loadUsers(),3000)
        }
    }
</script>
