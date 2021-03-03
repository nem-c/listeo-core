<?php 

/* Determine the type of form */
if(isset($_GET["action"])) {
	$form_type = $_GET["action"];
} else {
	$form_type = 'submit';
}
$current_user = wp_get_current_user();
$roles = $current_user->roles;
$role = array_shift( $roles ); 
if(!in_array($role,array('administrator','admin','owner'))) :
	$template_loader = new Listeo_Core_Template_Loader; 
	$template_loader->get_template_part( 'account/owner_only'); 
	return;
endif;
?>
<form action="<?php  echo esc_url( $data->action ); ?>" method="post" id="submit-listing-form" class="listing-manager-form" enctype="multipart/form-data">
	
	<div id="add-listing">

		<!-- Section -->
		<div class="add-listing-section type-selection">

			<!-- Headline -->
			<div class="add-listing-headline">
				<h3><?php esc_html_e('Choose Listing Type','listeo_core') ?></h3>
			</div>
			<?php 	$listing_types = get_option('listeo_listing_types',array( 'service', 'rental', 'event' )); 
					if(empty($listing_types)) { $listing_types = array('service'); } 
				?>
			<div class="row">
				<div class="col-lg-12">
					<div class="listing-type-container">
						<?php if(in_array('service',$listing_types)): ?>
						<a href="#" class="listing-type" data-type="service">
							<span class="listing-type-icon"><svg id="Layer_1" style="enable-background:new 0 0 100.353 100.352;" version="1.1" viewBox="0 0 100.353 100.352" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="M58.23,69.992l14.993-24.108c0.049-0.078,0.09-0.16,0.122-0.245c2.589-4.222,3.956-9.045,3.956-13.969   c0-14.772-12.018-26.79-26.79-26.79S23.72,16.898,23.72,31.67c0,4.925,1.369,9.75,3.96,13.975c0.03,0.074,0.065,0.146,0.107,0.216   l14.455,24.191c-11.221,1.586-18.6,6.2-18.6,11.797c0,6.935,11.785,12.366,26.829,12.366S77.3,88.783,77.3,81.849   C77.301,76.226,69.578,71.509,58.23,69.992z M30.373,44.294c-2.39-3.804-3.653-8.169-3.653-12.624   c0-13.118,10.672-23.79,23.791-23.79c13.118,0,23.79,10.672,23.79,23.79c0,4.457-1.263,8.822-3.652,12.624   c-0.05,0.08-0.091,0.163-0.124,0.249L54.685,70.01c-0.238,0.365-0.285,0.448-0.576,0.926l-4,6.432L30.507,44.564   C30.472,44.471,30.427,44.38,30.373,44.294z M50.472,91.215c-14.043,0-23.829-4.937-23.829-9.366c0-4.02,7.37-7.808,17.283-8.981   l4.87,8.151c0.269,0.449,0.751,0.726,1.274,0.73c0.004,0,0.009,0,0.013,0c0.518,0,1-0.268,1.274-0.708l5.12-8.232   C66.548,73.9,74.3,77.784,74.3,81.849C74.301,86.279,64.515,91.215,50.472,91.215z"/><path d="M60.213,31.67c0-5.371-4.37-9.741-9.741-9.741s-9.741,4.37-9.741,9.741s4.37,9.741,9.741,9.741   C55.843,41.411,60.213,37.041,60.213,31.67z M43.731,31.67c0-3.717,3.024-6.741,6.741-6.741s6.741,3.024,6.741,6.741   s-3.023,6.741-6.741,6.741S43.731,35.387,43.731,31.67z"/></g></svg></span>
							<h3><?php esc_html_e('Service','listeo_core') ?></h3>
						</a>
						<?php endif; ?>
						<?php if(in_array('rental',$listing_types)): ?>
						<a href="#" class="listing-type" data-type="rental">
							<span class="listing-type-icon"><svg enable-background="new 0 0 48 48" height="48px" version="1.1" viewBox="0 0 48 48" width="48px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Expanded"><g><g><path d="M42,48H28V35h-8v13H6V27c0-0.552,0.447-1,1-1s1,0.448,1,1v19h10V33h12v13h10V28c0-0.552,0.447-1,1-1s1,0.448,1,1V48z"/></g><g><path d="M47,27c-0.249,0-0.497-0.092-0.691-0.277L24,5.384L1.691,26.723c-0.399,0.381-1.032,0.368-1.414-0.031     c-0.382-0.399-0.367-1.032,0.031-1.414L24,2.616l23.691,22.661c0.398,0.382,0.413,1.015,0.031,1.414     C47.526,26.896,47.264,27,47,27z"/></g><g><path d="M39,15c-0.553,0-1-0.448-1-1V8h-6c-0.553,0-1-0.448-1-1s0.447-1,1-1h8v8C40,14.552,39.553,15,39,15z"/></g></g></g></svg></span>
							<h3><?php esc_html_e('Rent','listeo_core') ?></h3>
						</a>
						<?php endif; ?>
						<?php if(in_array('event',$listing_types)): ?>
						<a href="#" class="listing-type" data-type="event">
							<span class="listing-type-icon"><svg height="480pt" viewBox="0 -1 480 480" width="480pt" xmlns="http://www.w3.org/2000/svg"><path d="m78.878906 87.941406c1.472656 1.503906 3.496094 2.34375 5.601563 2.320313 1.066406.023437 2.128906-.164063 3.121093-.558594 1.921876-.855469 3.460938-2.394531 4.320313-4.320313.390625-.992187.582031-2.050781.558594-3.121093.019531-2.101563-.816407-4.125-2.320313-5.597657-.730468-.746093-1.601562-1.34375-2.558594-1.761718-1.480468-.550782-3.078124-.71875-4.640624-.480469-.480469.160156-1.039063.320313-1.519532.480469-.480468.160156-.960937.480468-1.363281.722656-.847656.632812-1.601563 1.390625-2.238281 2.238281-.238282.398438-.480469.878907-.71875 1.359375-.242188.480469-.320313 1.039063-.480469 1.519532-.066406.503906-.09375 1.011718-.082031 1.519531-.023438 1.070312.167968 2.128906.5625 3.121093.414062.960938 1.011718 1.828126 1.757812 2.558594zm0 0"/><path d="m61.921875 93.625c-2.351563 2.25-3.054687 5.730469-1.761719 8.71875.386719.972656.988282 1.847656 1.761719 2.558594 1.484375 1.542968 3.535156 2.410156 5.679687 2.402344 1.042969-.019532 2.074219-.238282 3.039063-.640626.972656-.386718 1.847656-.988281 2.558594-1.761718.746093-.730469 1.34375-1.601563 1.761719-2.558594 1.167968-3 .480468-6.40625-1.761719-8.71875-3.160157-3.003906-8.117188-3.003906-11.277344 0zm0 0"/><path d="m56.238281 110.582031c-1.476562-1.527343-3.511719-2.390625-5.636719-2.390625-2.128906 0-4.164062.863282-5.640624 2.390625-.792969.726563-1.394532 1.632813-1.761719 2.640625-.410157.960938-.625 1.996094-.640625 3.039063.023437 2.136719.886718 4.175781 2.402344 5.679687 1.507812 1.453125 3.507812 2.28125 5.597656 2.320313 2.121094-.015625 4.15625-.84375 5.679687-2.320313 1.492188-1.511718 2.328125-3.554687 2.320313-5.679687.015625-1.039063-.171875-2.070313-.558594-3.039063-.394531-.992187-.996094-1.890625-1.761719-2.640625zm0 0"/><path d="m84.480469 124.261719c1.070312-.011719 2.128906-.226563 3.121093-.636719.953126-.390625 1.824219-.960938 2.558594-1.683594 1.492188-1.511718 2.324219-3.554687 2.320313-5.679687.015625-1.039063-.175781-2.070313-.558594-3.039063-.398437-.992187-.996094-1.890625-1.761719-2.640625-1.480468-1.527343-3.515625-2.390625-5.640625-2.390625s-4.160156.863282-5.640625 2.390625c-.765625.75-1.363281 1.648438-1.757812 2.640625-.410156.960938-.628906 1.996094-.640625 3.039063.03125 4.40625 3.59375 7.972656 8 8zm0 0"/><path d="m73.199219 127.542969c-3.175781-2.960938-8.101563-2.960938-11.277344 0-.792969.726562-1.394531 1.632812-1.761719 2.640625-.410156.960937-.628906 1.996094-.640625 3.039062-.019531 3.25 1.929688 6.1875 4.933594 7.4375 3 1.246094 6.457031.550782 8.746094-1.757812 1.492187-1.511719 2.328125-3.554688 2.320312-5.679688.015625-1.039062-.175781-2.074218-.558593-3.039062-.394532-.992188-.996094-1.894532-1.761719-2.640625zm0 0"/><path d="m101.519531 73.304688c1.039063.015624 2.074219-.175782 3.039063-.5625.960937-.414063 1.828125-1.011719 2.5625-1.757813.769531-.710937 1.371094-1.585937 1.757812-2.5625.402344-.960937.621094-1.992187.640625-3.039063.007813-2.140624-.859375-4.191406-2.398437-5.679687-.710938-.769531-1.585938-1.371094-2.5625-1.761719-2.996094-1.183594-6.414063-.496094-8.71875 1.761719-1.519532 1.496094-2.355469 3.550781-2.320313 5.679687 0 2.113282.847657 4.140626 2.347657 5.628907 1.503906 1.488281 3.539062 2.3125 5.652343 2.292969zm0 0"/><path d="m115.441406 55.785156c.964844.382813 2 .574219 3.039063.558594 2.125.003906 4.167969-.828125 5.679687-2.320312 1.472656-1.527344 2.304688-3.558594 2.320313-5.679688-.042969-2.09375-.871094-4.09375-2.320313-5.601562-2.3125-2.242188-5.71875-2.929688-8.71875-1.757813-1.011718.363281-1.914062.96875-2.640625 1.757813-.746093.734374-1.34375 1.601562-1.761719 2.5625-.382812.964843-.574218 2-.558593 3.039062-.039063 2.128906.800781 4.183594 2.320312 5.679688.746094.765624 1.644531 1.363281 2.640625 1.761718zm0 0"/><path d="m56.238281 42.664062c-2.316406-2.238281-5.734375-2.894531-8.71875-1.679687-2.007812.726563-3.59375 2.308594-4.320312 4.320313-.410157.960937-.625 1.992187-.640625 3.039062.015625 2.121094.847656 4.152344 2.320312 5.679688.796875.703124 1.683594 1.296874 2.640625 1.761718.96875.382813 2 .574219 3.039063.558594.539062.027344 1.078125-.027344 1.601562-.160156.488282-.097656.972656-.230469 1.441406-.398438.496094-.238281.976563-.503906 1.4375-.800781.421876-.296875.820313-.617187 1.199219-.960937.347657-.378907.667969-.78125.960938-1.199219.296875-.464844.566406-.945313.800781-1.441407.171875-.46875.304688-.949218.398438-1.441406.132812-.519531.1875-1.058594.160156-1.597656.015625-1.039062-.171875-2.074219-.558594-3.039062-.464844-.957032-1.054688-1.84375-1.761719-2.640626zm0 0"/><path d="m73.199219 25.703125-1.199219-.960937c-.878906-.570313-1.855469-.976563-2.878906-1.199219-1.558594-.324219-3.179688-.15625-4.640625.480469-.957031.386718-1.824219.957031-2.558594 1.679687-1.5 1.515625-2.359375 3.550781-2.402344 5.679687.015625.535157.066407 1.070313.160157 1.601563l.480468 1.4375c.207032.496094.449219.976563.71875 1.441406.324219.417969.671875.820313 1.042969 1.199219.734375.722656 1.601563 1.292969 2.558594 1.679688.949219.449218 1.988281.667968 3.039062.640624.535157-.011718 1.070313-.066406 1.601563-.160156 1.023437-.222656 2-.628906 2.878906-1.199218.417969-.296876.820312-.617188 1.199219-.960938.367187-.359375.691406-.761719.960937-1.199219.296875-.460937.5625-.945312.800782-1.441406.167968-.46875.304687-.949219.398437-1.4375.132813-.523437.1875-1.0625.160156-1.601563.015625-1.039062-.175781-2.074218-.558593-3.039062-.4375-.972656-1.03125-1.863281-1.761719-2.640625zm0 0"/><path d="m39.28125 59.703125c-.382812-.367187-.78125-.714844-1.203125-1.039063-.460937-.273437-.941406-.511718-1.4375-.722656l-1.441406-.476562c-1.558594-.328125-3.179688-.160156-4.640625.476562-.988282.40625-1.886719 1.003906-2.636719 1.761719-1.453125 1.507813-2.28125 3.507813-2.320313 5.601563.011719.535156.066407 1.070312.160157 1.597656.222656 1.027344.628906 2 1.199219 2.882812l.960937 1.199219c.773437.730469 1.664063 1.324219 2.636719 1.757813.96875.386718 2 .578124 3.042968.5625.535157.023437 1.074219-.027344 1.597657-.160157.492187-.097656.972656-.230469 1.441406-.402343.496094-.234376.976563-.5 1.4375-.800782.441406-.269531.84375-.589844 1.203125-.957031.34375-.382813.664062-.78125.957031-1.199219.574219-.882812.980469-1.855468 1.203125-2.882812.089844-.527344.144532-1.0625.160156-1.597656.027344-1.050782-.191406-2.09375-.640624-3.042969-.390626-.953125-.960938-1.824219-1.679688-2.558594zm0 0"/><path d="m73.199219 59.703125c-.378907-.367187-.78125-.714844-1.199219-1.039063-.4375-.273437-.890625-.511718-1.359375-.722656-.480469-.15625-1.039063-.316406-1.519531-.476562-1.558594-.324219-3.179688-.15625-4.640625.476562-1.925781.859375-3.464844 2.398438-4.320313 4.320313-.410156.964843-.628906 1.996093-.640625 3.042969.015625.535156.066407 1.070312.160157 1.597656.160156.480468.320312 1.039062.480468 1.519531.207032.472656.449219.925781.71875 1.363281.324219.417969.671875.816406 1.042969 1.199219.730469.746094 1.597656 1.34375 2.558594 1.757813.964843.386718 2 .578124 3.039062.5625.539063.023437 1.078125-.027344 1.601563-.160157.515625-.097656 1.023437-.230469 1.519531-.402343.46875-.234376.925781-.503907 1.359375-.800782.871094-.550781 1.609375-1.285156 2.160156-2.15625.296875-.4375.5625-.890625.800782-1.363281.167968-.496094.304687-1.003906.398437-1.519531.132813-.523438.1875-1.0625.160156-1.597656.015625-1.042969-.175781-2.074219-.558593-3.042969-.417969-.957031-1.015626-1.828125-1.761719-2.558594zm0 0"/><path d="m77.121094 51.464844c.238281.476562.480468.878906.71875 1.359375.324218.417969.671875.820312 1.039062 1.199219.34375.386718.75.710937 1.199219.960937.425781.3125.882813.582031 1.363281.800781.496094.167969 1.003906.300782 1.519532.398438.496093.132812 1.007812.1875 1.519531.160156 2.128906.019531 4.175781-.816406 5.679687-2.320312 1.519532-1.496094 2.355469-3.550782 2.320313-5.679688.027343-.511719-.027344-1.023438-.160157-1.519531-.085937-.519531-.21875-1.027344-.398437-1.519531-.4375-.972657-1.03125-1.867188-1.761719-2.640626-.734375-.722656-1.605468-1.292968-2.558594-1.679687-1.460937-.632813-3.082031-.800781-4.640624-.480469-.527344.085938-1.039063.246094-1.519532.480469-.492187.15625-.953125.402344-1.363281.71875-.398437.320313-.878906.640625-1.199219.960937-1.492187 1.511719-2.324218 3.554688-2.320312 5.679688-.011719.535156.015625 1.070312.082031 1.597656.160156.480469.320313 1.042969.480469 1.523438zm0 0"/><path d="m95.839844 37.0625c.34375.386719.75.710938 1.199218.960938.4375.296874.890626.5625 1.359376.800781.496093.167969 1.003906.304687 1.523437.398437.519531.132813 1.058594.1875 1.597656.160156 2.105469.019532 4.128907-.816406 5.601563-2.320312.789062-.726562 1.394531-1.628906 1.757812-2.640625.410156-.960937.628906-1.992187.640625-3.039063-.023437-2.132812-.886719-4.175781-2.398437-5.679687-.738282-.722656-1.605469-1.292969-2.5625-1.679687-1.457032-.640626-3.078125-.808594-4.636719-.480469-1.027344.222656-2.003906.628906-2.882813 1.199219-.398437.320312-.878906.640624-1.199218.960937-1.492188 1.511719-2.324219 3.554687-2.320313 5.679687-.015625 1.039063.175781 2.074219.558594 3.039063.398437.996094.996094 1.894531 1.761719 2.640625zm0 0"/><path d="m58 79.222656c-.21875-.480468-.488281-.933594-.800781-1.359375-.25-.453125-.574219-.859375-.960938-1.199219-.378906-.371093-.777343-.71875-1.199219-1.039062-.480468-.242188-.878906-.480469-1.359374-.722656-.480469-.238282-1.039063-.320313-1.519532-.480469-2.644531-.457031-5.347656.375-7.28125 2.242187-.320312.320313-.640625.800782-.957031 1.199219-.320313.40625-.5625.867188-.722656 1.359375-.230469.480469-.390625.992188-.480469 1.519532-.089844.503906-.144531 1.011718-.160156 1.519531.003906 1.074219.222656 2.132812.640625 3.121093.386719.957032.960937 1.824219 1.679687 2.558594.777344.730469 1.667969 1.328125 2.640625 1.761719.492188.179687 1.003907.3125 1.519531.398437.496094.132813 1.007813.1875 1.519532.160157 2.132812.039062 4.1875-.800781 5.679687-2.320313 1.507813-1.503906 2.34375-3.550781 2.320313-5.679687.027344-.511719-.027344-1.023438-.160156-1.519531-.09375-.515626-.226563-1.023438-.398438-1.519532zm0 0"/><path d="m41.039062 96.183594c-.234374-.46875-.503906-.925782-.800781-1.359375-.246093-.453125-.570312-.859375-.957031-1.199219-.75-.765625-1.648438-1.367188-2.640625-1.761719-3-1.1875-6.417969-.496093-8.71875 1.761719-.320313.316406-.640625.796875-.960937 1.199219-.570313.878906-.976563 1.855469-1.199219 2.878906-.09375.527344-.148438 1.0625-.160157 1.601563.039063 2.089843.867188 4.089843 2.320313 5.597656 1.503906 1.515625 3.542969 2.378906 5.679687 2.402344 1.042969-.015626 2.078126-.230469 3.039063-.640626 1.007813-.367187 1.914063-.96875 2.640625-1.761718 1.5-1.472656 2.339844-3.496094 2.320312-5.597656.023438-.539063-.027343-1.078126-.160156-1.601563-.097656-.515625-.230468-1.023437-.402344-1.519531zm0 0"/><path d="m101.519531 107.304688c1.046875-.015626 2.078125-.230469 3.039063-.640626 1.925781-.859374 3.464844-2.398437 4.320312-4.320312.410156-.960938.628906-1.996094.640625-3.039062.007813-2.144532-.859375-4.195313-2.398437-5.679688-1.890625-1.875-4.589844-2.683594-7.199219-2.160156-.519531.09375-1.027344.226562-1.523437.398437-.476563.238281-.878907.480469-1.359376.71875-.847656.636719-1.601562 1.390625-2.238281 2.242188-.242187.480469-.480469.878906-.722656 1.359375-.167969.496094-.300781 1.003906-.398437 1.519531-.132813.523437-.1875 1.0625-.160157 1.601563-.019531 2.101562.816407 4.125 2.320313 5.597656 1.488281 1.542968 3.539062 2.410156 5.679687 2.402344zm0 0"/><path d="m112.800781 87.941406c.746094.765625 1.644531 1.367188 2.640625 1.761719.964844.386719 2 .574219 3.039063.558594 2.125.007812 4.167969-.824219 5.679687-2.320313.722656-.734375 1.292969-1.601562 1.679688-2.558594.410156-.988281.628906-2.046874.640625-3.121093-.015625-2.09375-.847657-4.105469-2.320313-5.597657-2.3125-2.246093-5.71875-2.933593-8.71875-1.761718-.996094.394531-1.894531.996094-2.640625 1.761718-1.503906 1.472657-2.339843 3.496094-2.320312 5.597657-.023438 1.070312.167969 2.128906.558593 3.121093.417969.960938 1.015626 1.828126 1.761719 2.558594zm0 0"/><path d="m132.398438 72.742188c.96875.386718 2 .578124 3.042968.5625 3.214844-.015626 6.109375-1.953126 7.347656-4.917969 1.238282-2.96875.582032-6.386719-1.667968-8.683594-2.3125-2.242187-5.71875-2.929687-8.722656-1.761719-1.007813.367188-1.914063.972656-2.636719 1.761719-3.101563 3.121094-3.101563 8.160156 0 11.28125.746093.765625 1.644531 1.363281 2.636719 1.757813zm0 0"/><path d="m474.910156 461.976562-36.652344-18.144531c-13.671874-6.703125-22.316406-20.625-22.257812-35.847656v-6.335937c-.019531-20.109376-10.789062-38.671876-28.238281-48.664063l-43.242188-24.6875c3.324219-8.804687 1.199219-18.738281-5.441406-25.410156l-5.832031-5.832031c7.433594-9.148438 7.09375-22.347657-.796875-31.101563l-135.074219-149.425781 11.59375-11.59375c1.5-1.5 2.34375-3.535156 2.34375-5.660156 0-2.121094-.84375-4.15625-2.34375-5.65625l-22.625-22.625c-1.5-1.5-3.535156-2.34375-5.65625-2.34375-1.546875.042968-3.050781.546874-4.3125 1.445312-8.945312-43.050781-48.296875-72.890625-92.164062-69.886719-43.867188 3-78.789063 37.917969-81.789063 81.789063-3 43.867187 26.839844 83.21875 69.890625 92.164062-.898438 1.261719-1.402344 2.761719-1.449219 4.3125 0 2.121094.84375 4.15625 2.34375 5.65625l22.625 22.621094c1.5 1.503906 3.535157 2.347656 5.660157 2.347656s4.160156-.84375 5.660156-2.347656l11.582031-11.589844 149.464844 135.09375c8.722656 7.964844 21.976562 8.308594 31.097656.800782l5.839844 5.839843c7.601562 7.65625 19.410156 9.226563 28.75 3.824219l45.945312 26.234375c12.445313 7.121094 20.136719 20.351563 20.167969 34.695313v6.335937c-.078125 21.324219 12.042969 40.816406 31.199219 50.183594l36.65625 18.144531c1.101562.535156 2.3125.808594 3.535156.796875 3.746094.035156 7.011719-2.527344 7.863281-6.171875.855469-3.644531-.933594-7.394531-4.300781-9.027344zm-435.644531-424.929687c20.074219-20.078125 50.078125-26.480469 76.601563-16.347656 26.523437 10.128906 44.617187 34.902343 46.195312 63.253906l-4 4c2.691406-2.699219 3.105469-6.917969.988281-10.089844-2.113281-3.167969-6.167969-4.40625-9.691406-2.960937-.972656.4375-1.863281 1.03125-2.640625 1.761718-1.46875 1.492188-2.300781 3.503907-2.320312 5.597657.011718.539062.066406 1.074219.160156 1.601562.089844.527344.25 1.039063.480468 1.519531.160157.492188.402344.953126.722657 1.359376.277343.429687.601562.832031.957031 1.199218 1.515625 1.5 3.550781 2.359375 5.679688 2.402344 2.128906-.03125 4.15625-.894531 5.65625-2.402344l-16.925782 16.929688c1.46875-1.496094 2.296875-3.503906 2.3125-5.601563-.019531-1.070312-.238281-2.125-.640625-3.117187-.386719-.957032-.960937-1.824219-1.679687-2.5625-2.3125-2.242188-5.71875-2.929688-8.722656-1.757813-.992188.394531-1.890626.996094-2.636719 1.757813-.722657.738281-1.292969 1.605468-1.683594 2.5625-.402344.992187-.617187 2.046875-.636719 3.117187.015625 2.097657.847656 4.105469 2.320313 5.601563.722656.789062 1.628906 1.394531 2.636719 1.761718.964843.410157 1.996093.625 3.042968.636719 2.128906-.027343 4.160156-.886719 5.664063-2.398437l-16.800781 16.800781c1.347656-1.488281 2.117187-3.414063 2.160156-5.425781-.011719-1.042969-.230469-2.078125-.640625-3.039063-.367188-.988281-.941407-1.886719-1.679688-2.640625-.796875-.703125-1.683593-1.296875-2.640625-1.757812-1.949218-.800782-4.132812-.800782-6.078125 0-1.996093.820312-3.582031 2.402344-4.402343 4.398437-.746094 1.957031-.746094 4.121094 0 6.082031.464843.953126 1.054687 1.84375 1.761718 2.636719.75.742188 1.648438 1.3125 2.640625 1.679688.960938.410156 1.992188.628906 3.039063.640625 2.007812-.042969 3.933594-.808594 5.421875-2.160156l-16.796875 16.800781c1.507812-1.5 2.371094-3.535157 2.398437-5.664063-.011719-1.042968-.230469-2.078125-.640625-3.039062-.367187-1.007813-.96875-1.914063-1.757812-2.640625-3.144532-3.050781-8.140625-3.050781-11.28125 0-.765625.746093-1.363282 1.648437-1.761719 2.640625-.382813.964844-.574219 2-.558594 3.039062-.007812 2.125.828125 4.167969 2.320313 5.679688.734375.722656 1.605468 1.292968 2.558594 1.679687.992187.40625 2.050781.621094 3.121093.640625 2.097657-.011718 4.105469-.839844 5.601563-2.3125l-16.929688 16.929688c1.507813-1.5 2.367188-3.53125 2.398438-5.65625-.039063-2.132813-.898438-4.164063-2.398438-5.679688-.367187-.359375-.769531-.679687-1.199218-.960937-.410157-.316407-.871094-.558594-1.359376-.71875-.484374-.234375-.996093-.394531-1.523437-.480469-2.605469-.488281-5.289063.316406-7.199219 2.160156-.730468.773438-1.324218 1.667969-1.757812 2.640625-.410156.960938-.628906 1.992188-.640625 3.039063-.015625 3.242187 1.925781 6.171875 4.917969 7.421875 2.996093 1.246093 6.445312.566406 8.738281-1.726563l-4 4c-28.359375-1.582031-53.136719-19.683594-63.261719-46.21875s-3.707031-56.542968 16.390625-76.613281zm62.230469 152.738281-11.320313-11.3125 90.511719-90.511718 11.3125 11.316406-11.3125 11.304687zm177.433594 128.597656-148.867188-134.550781 56-56 134.539062 148.878907c2.855469 3.164062 2.734376 8.011718-.28125 11.023437l-30.398437 30.402344c-3.019531 2.984375-7.84375 3.09375-10.992187.246093zm37.519531 7.199219-5.65625-5.65625 11.320312-11.320312 5.648438 5.65625c3.125 3.125 3.125 8.191406.003906 11.316406-3.125 3.128906-8.191406 3.128906-11.316406.003906zm0 0"/><path d="m476.671875 31.296875c-2.082031-1.503906-4.761719-1.914063-7.199219-1.105469l-96 32c-3.269531 1.089844-5.472656 4.148438-5.472656 7.59375v68.445313c-4.84375-2.878907-10.367188-4.414063-16-4.445313-17.671875 0-32 14.324219-32 32 0 17.671875 14.328125 32 32 32s32-14.328125 32-32v-90.234375l80-26.671875v57.351563c-4.84375-2.878907-10.367188-4.414063-16-4.445313-17.671875 0-32 14.324219-32 32 0 17.671875 14.328125 32 32 32s32-14.328125 32-32v-96c0-2.574218-1.242188-4.988281-3.328125-6.488281zm-124.671875 150.488281c-8.835938 0-16-7.164062-16-16 0-8.839844 7.164062-16 16-16s16 7.160156 16 16c0 8.835938-7.164062 16-16 16zm96-32c-8.835938 0-16-7.164062-16-16 0-8.839844 7.164062-16 16-16s16 7.160156 16 16c0 8.835938-7.164062 16-16 16zm0 0"/><path d="m165.800781 294.09375-112 32c-3.433593.984375-5.800781 4.121094-5.800781 7.691406v84.445313c-4.84375-2.878907-10.367188-4.414063-16-4.445313-17.671875 0-32 14.324219-32 32 0 17.671875 14.328125 32 32 32s32-14.328125 32-32v-73.953125l96-27.25v41.648438c-4.84375-2.878907-10.367188-4.414063-16-4.445313-17.671875 0-32 14.324219-32 32 0 17.671875 14.328125 32 32 32s32-14.328125 32-32v-112c0-2.511718-1.179688-4.875-3.183594-6.386718-2.003906-1.511719-4.601562-1.992188-7.015625-1.304688zm-133.800781 167.691406c-8.835938 0-16-7.164062-16-16 0-8.839844 7.164062-16 16-16s16 7.160156 16 16c0 8.835938-7.164062 16-16 16zm32-106.585937v-15.382813l96-27.425781v15.570313zm80 74.585937c-8.835938 0-16-7.164062-16-16 0-8.839844 7.164062-16 16-16s16 7.160156 16 16c0 8.835938-7.164062 16-16 16zm0 0"/></svg></span>
							<h3><?php esc_html_e('Event','listeo_core') ?></h3>
						</a>
						<?php endif; ?>
						<input type="hidden" id="listing_type" name="_listing_type">
					</div>
				</div>
			</div>
			
		</div>
	<div class="submit-page">

	<p>
		<input type="hidden" 	name="listeo_core_form" value="<?php echo $data->form; ?>" />
		<input type="hidden" 	name="listing_id" value="<?php echo esc_attr( $data->listing_id ); ?>" />
		<input type="hidden" 	name="step" value="<?php echo esc_attr( $data->step ); ?>" />
		<button type="submit" name="continue"  style="display: none" class="button margin-top-20"><?php echo esc_attr( $data->submit_button_text ); ?> <i class="fa fa-arrow-circle-right"></i></button>

	</p>

</form>
</div>
</div>