<template>
    <div>
        	<div class="content">
			<div class="container-fluid">
				
				<!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
				<div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
					<p class="_title0">Categories <Button size="small" @click="addModal=true"><Icon type="md-add" />Add Category</Button></p>

					<div class="_overflow _table_div">
						<table class="_table">
								<!-- TABLE TITLE -->
							<tr>
								<th>Id</th>
								<th>Category Name</th>
                                <th>Category Image</th>
								<th>Created At</th>
								<th>Action</th>
							</tr>
								<!-- TABLE TITLE -->


								<!-- ITEMS -->
							<tr v-for="(category,i) in categories" :key="i" v-if="categories.length">
								<td>{{ i+1 }}</td>
								<td class="table_name">{{ category.categoryName }}</td>
                                <td style="height: 100px; width:100px;">
									<img :src="category.iconImage" alt="">
								</td>
								<td>{{ category.created_at }}</td>
								<td>
									 <Button type="info" size="small" @click="showEditModal(category,i)">Edit</Button>
									 <Button type="error" size="small" @click="showTagDeleteModal(category,i)" :loading="category.isDeleting">Delete</Button>
								</td>
							</tr>
								<!-- ITEMS -->

								<!-- ITEMS -->
							
								<!-- ITEMS -->


						</table>
					</div>
				</div>

				<!-- category add modal  -->
				<Modal
					v-model="addModal"
					title="Add Category"
					:mask-closable="false"
					:closable="false">
                    <Input v-model="data.categoryName" placeholder="Enter category name..."  />
                    
                     <Upload
					 	ref="uploads"
                        type="drag"
                        :headers="{'x-csrf-token' : token, 'X-Requested-With' : 'XMLHttpRequest'}"
                        :on-success="handleSuccess"
                        :on-error="handleError"
                        :format="['jpg','jpeg','png']"
                        :max-size="2048"
                        :on-format-error="handleFormatError"
                        :on-exceeded-size="handleMaxSize"
                        action="/api/upload">
                        <div style="padding: 20px 0">
                            <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                            <p>Click or drag files here to upload</p>
                        </div>
                    </Upload>
                    <div style="height:100px;width:100px;" v-if="data.iconImage">
                        <img :src="`/uploads/${data.iconImage}`" alt="">
						<div class="demo-upload-list-cover">
							<Icon type="ios-trash-outline" style="color: red;" @click="deleteImage(true)"></Icon>
						</div>
					</div>
					
					<div slot="footer">
						<Button type="default" @click="addModal=false">Close</Button>
						<Button type="primary" @click="addCategory" :disabled="isAdding" :loading="isAdding">
							{{ isAdding ? 'Adding...' : 'Add Category' }}</Button>
					</div>
   				</Modal>

				<!-- category edit modal  -->
				<Modal
					v-model="editModal"
					title="Edit Category"
					:mask-closable="false"
					:closable="false">
					<Input v-model="editData.categoryName" placeholder="Enter category name..."  />
                    
                     <Upload v-show="isIconimagenew"
					 	ref="editDatauploads"
                        type="drag"
                        :headers="{'x-csrf-token' : token, 'X-Requested-With' : 'XMLHttpRequest'}"
                        :on-success="handleSuccess"
                        :on-error="handleError"
                        :format="['jpg','jpeg','png']"
                        :max-size="2048"
                        :on-format-error="handleFormatError"
                        :on-exceeded-size="handleMaxSize"
                        action="/api/upload">
                        <div style="padding: 20px 0">
                            <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                            <p>Click or drag files here to upload</p>
                        </div>
                    </Upload>
                    <div style="height:100px;width:100px;" v-if="editData.iconImage">
                        <img :src="`${editData.iconImage}`" alt="">
						<div class="demo-upload-list-cover">
							<Icon type="ios-trash-outline" style="color: red;" @click="deleteImage(false)"></Icon>
						</div>
					</div>
					
					<div slot="footer">
						<Button type="default" @click="addModal=false">Close</Button>
						<Button type="primary" @click="editCategory" :disabled="isAdding" :loading="isAdding">
							{{ isAdding ? 'Editing...' : 'Edit Category' }}</Button>
					</div>
   				</Modal>
				
				<!-- tag delete modal -->
				<Modal v-model="showdeleteModal" width="360">
					<p slot="header" style="color:#f60;text-align:center">
						<Icon type="ios-information-circle"></Icon>
						<span>Delete confirmation</span>
					</p>
					<div style="text-align:center">
						<p>Are you Sure to delete this Tag?</p>
					</div>
					<div slot="footer">
						<Button type="error" size="large" long :loading="isAdding" @click="deleteTag">Delete</Button>
					</div>
				</Modal>

			</div>
		</div>
    </div>
</template>

<script>
export default {
	data(){
		return {
			data: {
                iconImage: '',
				categoryName: ''
			},
			addModal: false,
			editModal: false,
			isAdding: false,
			categories: [],
			editData: {
				iconImage: '',
				categoryName: ''
			},
			index: -1,
			showdeleteModal: false,
			deleteitem: {},
            indx: -1,
            token: '',
			isIconimagenew: false
		}
	},

	methods : {
        handleSuccess (res, file) {
            this.data.iconImage = res
        },
         handleError (res, file) {
            this.$Notice.warning({
                title: 'The file format is incorrect',
                desc: `${file.errors.file.length ? file.errors.file[0] : 'Something went wrong!'}`
            });
        },
        handleFormatError (file) {
            this.$Notice.warning({
                title: 'The file format is incorrect',
                desc: 'File format of ' + file.name + ' is incorrect, please select jpg or png.'
            });
        },
        handleMaxSize (file) {
            this.$Notice.warning({
                title: 'Exceeding file size limit',
                desc: 'File  ' + file.name + ' is too large, no more than 2M.'
            });
        },
		async deleteImage(isAdd=true){
			//console.log(this.data.iconImage)
			if(!isAdd){
				//for editing
				this.isIconimagenew = true
				let image = this.editData.iconImage
				this.editData.iconImage = ''
				this.$refs.editDatauploads.clearFiles()
			}else{
				let image = this.data.iconImage
				this.data.iconImage = ''
				this.$refs.uploads.clearFiles()
			}
			
			const res = await this.callApi('post','api/delete_image', {imageName: image})
			if(res.status !=200){
				this.data.iconImage = image
				this.swr("Something Went Wrong!")
			}
		},
		async addCategory(){
			if(this.data.categoryName.trim()=='')
				return this.e("Category Name is Required")

			if(this.data.iconImage.trim()=='')
				return this.e("Category Image is Required")
			 this.data.iconImage = `/uploads/${this.data.iconImage}`
			const res = await this.callApi('post', 'api/create_category', this.data)
			if(res.status==201){
				this.categories.unshift(res.data)
				this.s('Category has been Added Successfully')
				this.addModal = false
				this.data.categoryName=""
				this.data.iconImage=""
			}else{
				if(res.status==422){
					if(res.data.errors.categoryName){
						this.i(res.data.errors.categoryName[0])
					}
					if(res.data.errors.iconImage){
						this.i(res.data.errors.iconImage[0])
					}
				}else{
					this.swr('Something Went Wrong! Please Try Again..')
				}
				
			}
		},

		async editCategory(){
			if(this.editData.categoryName.trim()=='')
				return this.e("Category Name is Required")

			const res = await this.callApi('post', 'api/edit_tag', this.editData)
			if(res.status==200){
				this.categories[this.index].tagName = this.editData.tagName
				this.s('Tag has been updated Successfully')
				this.editModal = false
			}else{
				if(res.status==422){
					if(res.data.errors.tagName){
						this.i(res.data.errors.tagName[0])
					}
				}else{
					this.swr('Something Went Wrong! Please Try Again..')
				}
				
			}
		},

		showEditModal(category,index){
			let obj= {
				id: category.id,
				categoryName: category.categoryName,
				iconImage:	  category.iconImage
			}
			this.editData= obj
			this.editModal= true
			this.index= index
		},

		async deleteTag(){
			const res=await this.callApi('post','api/delete_tag',this.deleteitem)
			if(res.status===200){
				this.categories.splice(this.indx,1)
				this.s('Tag has been deleted Successfully')
				this.showdeleteModal = false
			}else{
				this.swr('Something Went Wrong! Please Try Again..')
			}
		},
		showTagDeleteModal(tag,i)
		{
			this.deleteitem = tag,
			this.indx = i
			this.showdeleteModal = true
		}
		
	},
	async created(){
            this.token= window.Laravel.csrfToken
			const res = await this.callApi('get', 'api/get_categories')

			if(res.status==200){
				this.categories= res.data
			}else{
				this.swr('Something Went Wrong! Please Try Again..')
			}
		}
}
</script>