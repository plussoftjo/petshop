<template>
	<div class="slider">
		<v-btn class="info" @click="dialog  = !dialog">New Slider</v-btn>

			<v-container grid-list-lg>
				<v-layout row wrap>
					<v-flex xs6 v-for="slide in sliders" :key="slide.id"> 
						<v-card >
							<v-img
							:src="slide.image"
							contain></v-img>
							<v-card-actions>
								<div class="title">{{slide.place}}</div>
								<v-spacer></v-spacer>
								<v-btn class="red" icon @click="destroy(slide.id)"><v-icon>delete</v-icon></v-btn>
							</v-card-actions>							
						</v-card>
					</v-flex>
				</v-layout>
			</v-container>


		<v-dialog v-model="dialog" max-width="500px">
			<v-card>
					<div class="title">
						New Slider
					</div>
					<v-container grid-list-lg text-xs-center>
					<v-layout row wrap>
						<v-flex xs12>
							<v-btn class="red" @click="openImage" dark block>Add Picture</v-btn>
							<input 
							type="file" 
							ref="fileInput"
							@change="onFileChange"
							> 

						</v-flex>
						<v-flex xs12>
							<v-select
							:items="places"
							v-model="item.place"
							lable="مكان السلايد"
							solo></v-select>
						</v-flex>

						<v-flex xs6>
							<v-btn class="success" block @click="store">Save</v-btn>
						</v-flex>
						<v-flex xs6>
							<v-btn block @click="dialog = !dialog">Close</v-btn>
						</v-flex>
					</v-layout>	
					</v-container>
					
					
					
			</v-card>
		</v-dialog>	
	</div>
</template>
<script>
	export default {
		methods:{
			openImage() {
				const vm = this;
				vm.$refs.fileInput.click();
			},
			onFileChange(e) {
		        let files = e.target.files || e.dataTransfer.files;
		         if (!files.length)
		            return;
		        this.createImage(files[0]);
		      },
		      createImage(file) {
		         let reader = new FileReader();
		          let vm = this;
		          reader.onload = (e) => {
		              vm.item.image = e.target.result;
		          };
		          reader.readAsDataURL(file);
		      },
		     	store() {
		     		const vm = this;
		     		axios.post('slider/store',vm.item).then(response => {
		     			location.reload();
		     		}).catch(err => {
		     			console.log(err)
		     		});
		     	},
		     	destroy(id)
		     	{
		     		confirm('هل تريد الحذف') && axios.get('slider/destroy/' + id).then(response => {
		     			location.reload();
		     		});
		     	}
		},
		data() {
			return {
				item:{image:'',place:''},
				dialog:false,
				places:['main','قطط','كلاب'],
				sliders:[]

			}
		},
		created() {
			const vm = this;
			axios.get('slider/index').then(response => {
				vm.sliders = response.data;
			});
		}
	}
</script>
<style scoped>
    input[type=file] {
        position: absolute;
        left: -99999px;
    }
</style>
