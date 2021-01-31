<template>
    <div>
        	<div class="content">
			<div class="container-fluid">
				
				<!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
				<div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
					<p class="_title0">Tags <Button size="small" @click="addModal=true"><Icon type="md-add" />Add Tag</Button></p>

					<div class="_overflow _table_div">
						<table class="_table">
								<!-- TABLE TITLE -->
							<tr>
								<th>Id</th>
								<th>Tag Name</th>
								<th>Created At</th>
								<th>Action</th>
							</tr>
								<!-- TABLE TITLE -->


								<!-- ITEMS -->
							<tr v-for="(tag,i) in tags" :key="i" v-if="tags.length">
								<td>{{ i+1 }}</td>
								<td class="_table_name">{{ tag.tagName }}</td>
								<td>{{ tag.created_at }}</td>
								<td>
									 <Button type="info" size="small" @click="showEditModal(tag,i)">Edit</Button>
									 <Button type="error" size="small" @click="showTagDeleteModal(tag,i)" :loading="tag.isDeleting">Delete</Button>
								</td>
							</tr>
								<!-- ITEMS -->

								<!-- ITEMS -->
							
								<!-- ITEMS -->


						</table>
					</div>
				</div>

				<!-- tag add modal  -->
				<Modal
					v-model="addModal"
					title="Add Tag"
					:mask-closable="false"
					:closable="false">
					<Input v-model="data.tagName" placeholder="Enter tag name..." style="width: 300px" />
					<div slot="footer">
						<Button type="default" @click="addModal=false">Close</Button>
						<Button type="primary" @click="addTag" :disabled="isAdding" :loading="isAdding">
							{{ isAdding ? 'Adding...' : 'Add Tag' }}</Button>
					</div>
   				</Modal>

				<!-- tag edit modal  -->
				<Modal
					v-model="editModal"
					title="Edit Tag"
					:mask-closable="false"
					:closable="false">
					<Input v-model="editData.tagName"  style="width: 300px" />
					<div slot="footer">
						<Button type="default" @click="editModal=false">Close</Button>
						<Button type="primary" @click="editTag" :disabled="isAdding" :loading="isAdding">
							{{ isAdding ? 'Updating...' : 'Update Tag' }}</Button>
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
				tagName: ''
			},
			addModal: false,
			editModal: false,
			isAdding: false,
			tags: [],
			editData: {
				tagName: ''
			},
			index: -1,
			showdeleteModal: false,
			deleteitem: {},
			indx: -1,
		}
	},

	methods : {
		async addTag(){
			if(this.data.tagName.trim()=='')
				return this.e("Tag Name is Required")

			const res = await this.callApi('post', 'api/create_tag', this.data)
			if(res.status==201){
				this.tags.unshift(res.data)
				this.s('Tag has been Added Successfully')
				this.addModal = false
				this.data.tagName=""
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

		async editTag(){
			if(this.editData.tagName.trim()=='')
				return this.e("Tag Name is Required")

			const res = await this.callApi('post', 'api/edit_tag', this.editData)
			if(res.status==200){
				this.tags[this.index].tagName = this.editData.tagName
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

		showEditModal(tag,index){
			let obj= {
				id: tag.id,
				tagName: tag.tagName
			}
			this.editData= obj
			this.editModal= true
			this.index= index
		},

		async deleteTag(){
			const res=await this.callApi('post','api/delete_tag',this.deleteitem)
			if(res.status===200){
				this.tags.splice(this.indx,1)
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
			const res = await this.callApi('get', 'api/get_tags')

			if(res.status==200){
				this.tags= res.data
			}else{
				this.swr('Something Went Wrong! Please Try Again..')
			}
		}
}
</script>