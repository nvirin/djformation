( function() {
    tinymce.PluginManager.add( 'coco_shortcode_drop', function( editor, url ) {
		
		coco_shortcodesEd = editor;
		coco_shortcodesUrl = url;
		// We go up in the tree
		cs_url = coco_shortcodesUrl.substring(0, coco_shortcodesUrl.length-2);
		
		var buttonstyle = "background:url('" + cs_url + "img/cocorico.png') no-repeat 5px 2px";
		
		var buttoncolors = [	{	text: editor.getLang('coco_shortcodes_tinymce.button_grey'),
                					value: editor.getLang('coco_shortcodes_tinymce.button_grey_value')
                				},
                				{	text: editor.getLang('coco_shortcodes_tinymce.button_purple'),
                					value: editor.getLang('coco_shortcodes_tinymce.button_purple_value')
                				},
                				{	text: editor.getLang('coco_shortcodes_tinymce.button_blue'),
                					value: editor.getLang('coco_shortcodes_tinymce.button_blue_value')
                				},
		            			{	text: editor.getLang('coco_shortcodes_tinymce.button_turquoise'),
		            				value: editor.getLang('coco_shortcodes_tinymce.button_turquoise_value')
		            			},
		            			{	text: editor.getLang('coco_shortcodes_tinymce.button_green'),
                					value: editor.getLang('coco_shortcodes_tinymce.button_green_value')
                				},
                				{	text: editor.getLang('coco_shortcodes_tinymce.button_yellow'),
                					value: editor.getLang('coco_shortcodes_tinymce.button_yellow_value')
                				},
                				{	text: editor.getLang('coco_shortcodes_tinymce.button_orange'),
                					value: editor.getLang('coco_shortcodes_tinymce.button_orange_value')
                				},
                				{	text: editor.getLang('coco_shortcodes_tinymce.button_red'),
                					value: editor.getLang('coco_shortcodes_tinymce.button_red_value')
                				},
		            			{	text: editor.getLang('coco_shortcodes_tinymce.button_pink'),
		            				value: editor.getLang('coco_shortcodes_tinymce.button_pink_value')
		            			},
                				{	text: editor.getLang('coco_shortcodes_tinymce.button_nightblue'),
                					value: editor.getLang('coco_shortcodes_tinymce.button_nightblue_value')
                				}
						    ];
		
        editor.addButton( 'coco_shortcodes_button', {
			type: 'menubutton',
            style: buttonstyle,
            tooltip: 'Cocorico Shortcodes',
            menu: [
            		// BEGIN column
            		{	text: editor.getLang('coco_shortcodes_tinymce.column'),
            			
            			// BEGIN onclick
            			onclick: function() {
            			
				            // BEGIN Popup
				            editor.windowManager.open({
				                title: editor.getLang('coco_shortcodes_tinymce.column_add'),
				                // BEGIN body popup
				                body: [	{	type: 'listbox',
					                    	name: 'size_col',
					                    	label: editor.getLang('coco_shortcodes_tinymce.column_size'),
					                    	values:[	{text: '1/2', value: editor.getLang('coco_shortcodes_tinymce.column_one_half')},
								            			{text: '1/3', value: editor.getLang('coco_shortcodes_tinymce.column_one_third')},
								            			{text: '2/3', value: editor.getLang('coco_shortcodes_tinymce.column_two_thirds')},
								            			{text: '1/4', value: editor.getLang('coco_shortcodes_tinymce.column_one_fourth')},
								            			{text: '3/4', value: editor.getLang('coco_shortcodes_tinymce.column_three_fourths')}
												    ]
					                    },
					                    
					                    {	type: 'listbox',
					                    	name: 'position_col',
					                    	label: editor.getLang('coco_shortcodes_tinymce.column_position'),
					                    	values:[	{	text: editor.getLang('coco_shortcodes_tinymce.column_first'),
					                    					value: editor.getLang('coco_shortcodes_tinymce.column_first_value')
					                    				},
					                    				{	text: editor.getLang('coco_shortcodes_tinymce.column_middle'),
					                    					value: editor.getLang('coco_shortcodes_tinymce.column_middle_value')
					                    				},
								            			{	text: editor.getLang('coco_shortcodes_tinymce.column_last'),
								            				value: editor.getLang('coco_shortcodes_tinymce.column_last_value')
								            			}
												    ]
					                    },
					                    
					                    {	type: 'textbox',
					                    	name: 'content_col',
					                    	label: editor.getLang('coco_shortcodes_tinymce.column_content'),
					                    	multiline: true,
					                    	minWidth: 300,
					                    	minHeight: 100
										}

				                ],
				                // END body popup
				                
				                onsubmit: function(e) {
				                
				                	var res = '';
				                	
				                	res += '[' + editor.getLang('coco_shortcodes_tinymce.column_shortcode') + ' ' + editor.getLang('coco_shortcodes_tinymce.column_size_att') + '="' + e.data.size_col + '" ' + editor.getLang('coco_shortcodes_tinymce.column_position_att') + '="' + e.data.position_col+ '"]<br>';
				                	res += e.data.content_col + '<br>[/' + editor.getLang('coco_shortcodes_tinymce.column_shortcode') + ']<br><br>';
				                	
				                    editor.insertContent(res);
				                }
				                
				                
				            });
				            // END Popup
				        },
            			// END onclick
            		},
					// END column
					            		
            		
            		// BEGIN message
            		{	text: editor.getLang('coco_shortcodes_tinymce.message'),
            			
            			// BEGIN onclick
            			onclick: function() {
            			
				            // BEGIN Popup
				            editor.windowManager.open({
				                title: editor.getLang('coco_shortcodes_tinymce.message_add'),
				                // BEGIN body popup
				                body: [	{	type: 'listbox',
					                    	name: 'message_type',
					                    	label: editor.getLang('coco_shortcodes_tinymce.message_type'),
					                    	values:[	{	text: editor.getLang('coco_shortcodes_tinymce.message_classic'),
					                    					value: editor.getLang('coco_shortcodes_tinymce.message_classic_value')
					                    				},
					                    				{	text: editor.getLang('coco_shortcodes_tinymce.message_info'),
					                    					value: editor.getLang('coco_shortcodes_tinymce.message_info_value')
					                    				},
					                    				{	text: editor.getLang('coco_shortcodes_tinymce.message_alert'),
					                    					value: editor.getLang('coco_shortcodes_tinymce.message_alert_value')
					                    				},
								            			{	text: editor.getLang('coco_shortcodes_tinymce.message_error'),
								            				value: editor.getLang('coco_shortcodes_tinymce.message_error_value')
								            			},
								            			{	text: editor.getLang('coco_shortcodes_tinymce.message_success'),
								            				value: editor.getLang('coco_shortcodes_tinymce.message_success_value')
								            			}
												    ]
										},
				                    
					                    {	type: 'textbox',
					                    	name: 'message_content',
					                    	label: editor.getLang('coco_shortcodes_tinymce.message_content'),
					                    	multiline: true,
					                    	minWidth: 300,
					                    	minHeight: 100
										}

				                ],
				                // END body popup
				                
				                onsubmit: function(e) {
				                
				                	var res = '';
				                	
				                	res += '[' + editor.getLang('coco_shortcodes_tinymce.message_shortcode') + ' ' + editor.getLang('coco_shortcodes_tinymce.message_type_att') + '="' + e.data.message_type + '"]<br>';
				                	res += e.data.message_content + '<br>[/' + editor.getLang('coco_shortcodes_tinymce.message_shortcode') + ']<br><br>';
				                	
				                    editor.insertContent(res);
				                }
				                
				                
				            });
				            // END Popup
				        },
            			// END onclick
            		},
					// END message
					
					// BEGIN button
            		{	text: editor.getLang('coco_shortcodes_tinymce.button'),
            			
            			// BEGIN onclick
            			onclick: function() {
            			
				            // BEGIN Popup
				            editor.windowManager.open({
				                title: editor.getLang('coco_shortcodes_tinymce.button_add'),
				                // BEGIN body popup
				                body: [	{	type: 'textbox',
					                    	name: 'button_url',
					                    	label: editor.getLang('coco_shortcodes_tinymce.button_url')
										},
										
										{	type: 'textbox',
					                    	name: 'button_label',
					                    	label: editor.getLang('coco_shortcodes_tinymce.button_label')
										},
										
										{	type: 'listbox',
					                    	name: 'button_target',
					                    	label: editor.getLang('coco_shortcodes_tinymce.button_target'),
					                    	values:[	{	text: editor.getLang('coco_shortcodes_tinymce.button_link_same'),
					                    					value: editor.getLang('coco_shortcodes_tinymce.button_link_same_value')
					                    				},
					                    				{	text: editor.getLang('coco_shortcodes_tinymce.button_link_other'),
					                    					value: editor.getLang('coco_shortcodes_tinymce.button_link_other_value')
					                    				}
												    ]
										},
										
										{	type: 'label',
					                    	name: 'button_style_label',
					                    	label: editor.getLang('coco_shortcodes_tinymce.button_style_label')
										},
										
				                		{	type: 'listbox',
					                    	name: 'button_size',
					                    	label: editor.getLang('coco_shortcodes_tinymce.button_size'),
					                    	values:[	{	text: editor.getLang('coco_shortcodes_tinymce.button_small'),
					                    					value: editor.getLang('coco_shortcodes_tinymce.button_small_value')
					                    				},
					                    				{	text: editor.getLang('coco_shortcodes_tinymce.button_medium'),
					                    					value: editor.getLang('coco_shortcodes_tinymce.button_medium_value')
					                    				},
								            			{	text: editor.getLang('coco_shortcodes_tinymce.button_large'),
								            				value: editor.getLang('coco_shortcodes_tinymce.button_large_value')
								            			}
												    ]
										},
				                    
					                    {	type: 'listbox',
					                    	name: 'button_color',
					                    	label: editor.getLang('coco_shortcodes_tinymce.button_color'),
					                    	values: buttoncolors
										},

				                ],
				                // END body popup
				                
				                onsubmit: function(e) {
				                
				                	var res = '';
				                	
				                	res += '[' + editor.getLang('coco_shortcodes_tinymce.button_shortcode') + ' ';
				                	
				                	// URL and target attributes
				                	res += editor.getLang('coco_shortcodes_tinymce.button_url_att') + '="' + e.data.button_url + '" ';
				                	res += editor.getLang('coco_shortcodes_tinymce.button_target_att') + '="' + e.data.button_target + '" ';
				                	// Styling attributes (size, alignement and color)
				                	res += editor.getLang('coco_shortcodes_tinymce.button_size_att') + '="' + e.data.button_size + '" ';
				                	res += editor.getLang('coco_shortcodes_tinymce.button_color_att') + '="' + e.data.button_color + '"]';
				                	
				                	res += e.data.button_label;
				                	
				                	res += '[/' + editor.getLang('coco_shortcodes_tinymce.button_shortcode') + ']<br><br>';
				                	
				                    editor.insertContent(res);
				                }
				                
				                
				            });
				            // END Popup
				        },
            			// END onclick
            		},
					// END button
            		
            		
            		// BEGIN tabs
            		{	text: editor.getLang('coco_shortcodes_tinymce.tabs'),
            			
            			// BEGIN onclick
            			onclick: function() {
            			
				            // BEGIN Popup
				            editor.windowManager.open({
				                title: editor.getLang('coco_shortcodes_tinymce.tabs_add'),
				                // BEGIN body popup
				                body: [	{	type: 'label',
					                    	name: 'tabs_label',
					                    	label: editor.getLang('coco_shortcodes_tinymce.tabs_label')
										},
				                
				                		{	type: 'listbox',
					                    	name: 'tabs_number',
					                    	label: editor.getLang('coco_shortcodes_tinymce.tabs_number'),
					                    	values:[	{	text: '2', value: 2},
					                    				{	text: '3', value: 3},
								            			{	text: '4', value: 4},
								            			{	text: '5', value: 5}
												    ]
										}

				                ],
				                // END body popup
				                
				                onsubmit: function(e) {
				                
				                	var res = '';
				                	
				                	res += '[' + editor.getLang('coco_shortcodes_tinymce.tabs_shortcode') + ']<br>';
				                	
				                	for (i = 1; i <= e.data.tabs_number; i++) { 
									    res += '[' + editor.getLang('coco_shortcodes_tinymce.single_tab_shortcode') + ' ' + editor.getLang('coco_shortcodes_tinymce.tab_label_att') + '="' + editor.getLang('coco_shortcodes_tinymce.tab_label_value') + ' ' + i + '"]';
									    res += editor.getLang('coco_shortcodes_tinymce.tab_content') + ' ' + i;
									    res += '[/' + editor.getLang('coco_shortcodes_tinymce.single_tab_shortcode') + ']<br>';
									}
				                	res += '[/' + editor.getLang('coco_shortcodes_tinymce.tabs_shortcode') + ']<br>';
				                					                	
				                    editor.insertContent(res);
				                }
				                
				                
				            });
				            // END Popup
				        },
            			// END onclick
            		},
					// END tabs
            		
            		// BEGIN separator
            		{	text: editor.getLang('coco_shortcodes_tinymce.separator'),
            			
            			// BEGIN onclick
            			onclick: function() {
            			
				            // BEGIN Popup
				            editor.windowManager.open({
				                title: editor.getLang('coco_shortcodes_tinymce.separator_add'),
				                // BEGIN body popup
				                body: [	{	type: 'listbox',
					                    	name: 'separator_style',
					                    	label: editor.getLang('coco_shortcodes_tinymce.separator_style'),
					                    	values:[	{	text: editor.getLang('coco_shortcodes_tinymce.separator_solid'),
					                    					value: editor.getLang('coco_shortcodes_tinymce.separator_solid_value')
					                    				},
					                    				{	text: editor.getLang('coco_shortcodes_tinymce.separator_dashed'),
					                    					value: editor.getLang('coco_shortcodes_tinymce.separator_dashed_value')
					                    				},
					                    				{	text: editor.getLang('coco_shortcodes_tinymce.separator_dotted'),
					                    					value: editor.getLang('coco_shortcodes_tinymce.separator_dotted_value')
					                    				},
								            			{	text: editor.getLang('coco_shortcodes_tinymce.separator_double'),
								            				value: editor.getLang('coco_shortcodes_tinymce.separator_double_value')
								            			}
												    ]
										}

				                ],
				                // END body popup
				                
				                onsubmit: function(e) {
				                
				                	var res = '';
				                	
				                	res += '[' + editor.getLang('coco_shortcodes_tinymce.separator_shortcode') + ' ';
				                	 
									res += editor.getLang('coco_shortcodes_tinymce.separator_style_att') + '="' + e.data.separator_style + '"]<br>';
				                					                	
				                    editor.insertContent(res);
				                }
				                
				                
				            });
				            // END Popup
				        },
            			// END onclick
            		},
					// END separator
					
					// BEGIN toggle
            		{	text: editor.getLang('coco_shortcodes_tinymce.toggle'),
            			
            			// BEGIN onclick
            			onclick: function() {
            			
				            // BEGIN Popup
				            editor.windowManager.open({
				                title: editor.getLang('coco_shortcodes_tinymce.toggle_add'),
				                // BEGIN body popup
				                body: [	{	type: 'textbox',
					                    	name: 'toggle_title',
					                    	label: editor.getLang('coco_shortcodes_tinymce.toggle_title'),
										},
										{	type: 'textbox',
					                    	name: 'toggle_content',
					                    	label: editor.getLang('coco_shortcodes_tinymce.toggle_content'),
					                    	multiline: true,
					                    	minWidth: 300,
					                    	minHeight: 100
										}
				                ],
				                // END body popup
				                
				                onsubmit: function(e) {
				                
				                	var res = '';
				                	
				                	res += '[' + editor.getLang('coco_shortcodes_tinymce.toggle_shortcode') + ' ';
									res += editor.getLang('coco_shortcodes_tinymce.toggle_title_att') + '="' + e.data.toggle_title + '"]<br>';
				                	
				                	res += e.data.toggle_content + '<br>';
				                	
				                	res += '[/' + editor.getLang('coco_shortcodes_tinymce.toggle_shortcode') + ']';
				                	              	
				                    editor.insertContent(res);
				                }
				                
				                
				            });
				            // END Popup
				        },
            			// END onclick
            		},
					// END toggle
					
					
					// BEGIN call to action
            		{	text: editor.getLang('coco_shortcodes_tinymce.cta'),
            			
            			// BEGIN onclick
            			onclick: function() {
            			
				            // BEGIN Popup
				            editor.windowManager.open({
				                title: editor.getLang('coco_shortcodes_tinymce.cta_add'),
				                // BEGIN body popup
				                body: [	{	type: 'textbox',
					                    	name: 'cta_title',
					                    	label: editor.getLang('coco_shortcodes_tinymce.cta_title'),
										},
										{	type: 'textbox',
					                    	name: 'cta_content',
					                    	label: editor.getLang('coco_shortcodes_tinymce.cta_content'),
					                    	multiline: true,
					                    	minWidth: 300,
					                    	minHeight: 100
										},
										{	type: 'textbox',
					                    	name: 'cta_url',
					                    	label: editor.getLang('coco_shortcodes_tinymce.cta_url'),
										},
										{	type: 'textbox',
					                    	name: 'cta_label',
					                    	label: editor.getLang('coco_shortcodes_tinymce.cta_label'),
										},
										{	type: 'listbox',
					                    	name: 'cta_color',
					                    	label: editor.getLang('coco_shortcodes_tinymce.cta_color'),
					                    	values : buttoncolors
										},
										
										
				                ],
				                // END body popup
				                
				                onsubmit: function(e) {
				                
				                	var res = '';
				                	
				                	res += '[' + editor.getLang('coco_shortcodes_tinymce.cta_shortcode') + ' ';
				                	
									res += editor.getLang('coco_shortcodes_tinymce.cta_title_att') + '="' + e.data.cta_title + '" ';
				                	res += editor.getLang('coco_shortcodes_tinymce.cta_url_att') + '="' + e.data.cta_url + '" ';
				                	res += editor.getLang('coco_shortcodes_tinymce.cta_color_att') + '="' + e.data.cta_color + '" ';
				                	res += editor.getLang('coco_shortcodes_tinymce.cta_label_att') + '="' + e.data.cta_label + '"]<br>';
				                	
				                	res += e.data.cta_content + '<br>';
				                	
				                	res += '[/' + editor.getLang('coco_shortcodes_tinymce.cta_shortcode') + ']';
				                	              	
				                    editor.insertContent(res);
				                }
				                
				                
				            });
				            // END Popup
				        },
            			// END onclick
            		},
					// END call to action
            		
	        ]
            

        } );

		
    } );

} )();