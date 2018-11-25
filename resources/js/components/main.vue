<template>
	<v-app id="main">
			 <v-navigation-drawer
		     v-model='drawer' app stateless floating
		      	 class="teal lighten-5"
		    >
		      <v-toolbar flat class="teal">
		        <v-list class="pa-0">
		          <v-list-tile >
		            <v-list-tile-content>
		              <v-list-tile-title style="color: white;">Admin Panel</v-list-tile-title>
		            </v-list-tile-content>
		          </v-list-tile>
		        </v-list>
		      </v-toolbar>

		      <v-list class="pt-0" dense>
		        <v-divider></v-divider>

		        <v-list-tile
		          v-for="item in items"
		          :key="item.title"
		          @click="$router.push({name:item.at})"
		        >
		        <!--   <v-list-tile-action>
		            <v-icon>{{ item.icon }}</v-icon>
		          </v-list-tile-action> -->

		          <v-list-tile-content>
		            <v-list-tile-title>{{ item.title }}</v-list-tile-title>
		          </v-list-tile-content>
		        </v-list-tile>
		      </v-list>
		    </v-navigation-drawer>

		    
 			<v-content>
 				<v-toolbar app>
				    <v-toolbar-side-icon @click="drawer =!drawer"></v-toolbar-side-icon>
				    <v-toolbar-title>{{$router.currentRoute.name}}</v-toolbar-title>
				    <v-spacer></v-spacer>
				</v-toolbar>
 				
						<v-card>
							<v-container grid-list-md>
								<router-view></router-view>
							</v-container>
						</v-card>
			</v-content>
	</v-app>
</template>
<script>
	export default {
		data() {
			return {
				drawer: true,
		        items: [
		          { title: 'Main', icon: 'dashboard',at:'main' },
		          { title: 'Proudct', icon: 'question_answer',at:"proudct" },
		        ],
		        right: null,
		        
			}
		}
	}
</script>
<style>
	
</style>