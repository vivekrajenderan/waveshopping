$(document).ready(function() {

				
				//Start Add task Validation

				
				$("#successtask").hide();
				$("#errortask").hide();
				$("#addtaskform").validate({
                    highlight: function(element) {
                        $(element).closest('.elVal').addClass("form-field text-error");
                    },
                    unhighlight: function(element) {
                        $(element).closest('.elVal').removeClass("form-field text-error");
                    }, errorElement: 'span',
                    rules: {
                            	   title: {
                                            required: true,                                           
                                            minlength: 4,                                            
                                            maxlength: 60,
                                   },
                                   description: {
                                            required: true,                                           
                                            minlength: 4                                            
                                            
                                   },
                                   priority: {
                                            required: true                                          
                                            
                                   },
                                   status: {
                                            required: true                                          
                                            
                                   },
                                   user_id: {
                                            required: true                             
                                            
                                   }
                       				                     
                    },
                    messages: {
                        		title: {
                            			required: "Please enter title"
                            
                           			  },
                           		description: {
                            			required: "Please enter description"
                            
                           			  },
                           		priority: {
                            			required: "Please select priority"
                            
                           			  },
                           		status: {
                            			required: "Please select status"
                            
                           			  },
                           		user_id: {
                            			required: "Please select user"
                            
                           			  }
                                             
                    },
                    errorPlacement: function(error, element) {
                        error.appendTo( element.closest(".elVal") );
                    },
                    submitHandler: function(form) {                      
						var url_path="addtask/addtasksuccess";
				        var formData = new FormData(document.getElementById("addtaskform"));
				        var xmlhttp;
				        if (window.XMLHttpRequest)
				          {// code for IE7+, Firefox, Chrome, Opera, Safari
				          xmlhttp=new XMLHttpRequest();
				          }
				        else
				          {// code for IE6, IE5
				          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				          }
				        xmlhttp.onreadystatechange=function()
				          {
				          if (xmlhttp.readyState==4 && xmlhttp.status==200)
				            {
				            
				            var json = $.parseJSON(xmlhttp.responseText);
				            
				            if(json.response=="success")
				            {
				              document.getElementById('successtask').style.display='block';				              
					     	  document.getElementById('addtaskform').reset();
					     	  setTimeout(function() {
		                      $('#successtask').hide('slow');
		                      }, 4000);
				            }
				            else
				            {
					      	  document.getElementById('errortask').style.display='block';
				              document.getElementById("errortask").innerHTML=json.msg;
				              
				               setTimeout(function() {
				               $('#errortask').hide('slow');
		                      }, 4000);
					      	
				            }
				            
				            }
					        }
					        xmlhttp.open("POST",url_path,true);
					        xmlhttp.send(formData);
					      }
                });

				//End Advertisement Validaion


				//Start Add task Validation

				
				$("#successtaskedit").hide();
				$("#errortaskedit").hide();
				$("#edittaskform").validate({
                    highlight: function(element) {
                        $(element).closest('.elVal').addClass("form-field text-error");
                    },
                    unhighlight: function(element) {
                        $(element).closest('.elVal').removeClass("form-field text-error");
                    }, errorElement: 'span',
                    rules: {
                            	   title: {
                                            required: true,                                           
                                            minlength: 4,                                            
                                            maxlength: 60,
                                   },
                                   description: {
                                            required: true,                                           
                                            minlength: 4                                            
                                            
                                   },
                                   priority: {
                                            required: true                                          
                                            
                                   },
                                   status: {
                                            required: true                                          
                                            
                                   },
                                   user_id: {
                                            required: true                             
                                            
                                   }
                       				                     
                    },
                    messages: {
                        		title: {
                            			required: "Please enter title"
                            
                           			  },
                           		description: {
                            			required: "Please enter description"
                            
                           			  },
                           		priority: {
                            			required: "Please select priority"
                            
                           			  },
                           		status: {
                            			required: "Please select status"
                            
                           			  },
                           		user_id: {
                            			required: "Please select user"
                            
                           			  }
                                             
                    },
                    errorPlacement: function(error, element) {
                        error.appendTo( element.closest(".elVal") );
                    },
                    submitHandler: function(form) {                      
						var url_path="edittasksuccess";
				        var formData = new FormData(document.getElementById("edittaskform"));
				        var xmlhttp;
				        if (window.XMLHttpRequest)
				          {// code for IE7+, Firefox, Chrome, Opera, Safari
				          xmlhttp=new XMLHttpRequest();
				          }
				        else
				          {// code for IE6, IE5
				          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				          }
				        xmlhttp.onreadystatechange=function()
				          {
				          if (xmlhttp.readyState==4 && xmlhttp.status==200)
				            {
				            
				            var json = $.parseJSON(xmlhttp.responseText);
				            
				            if(json.response=="success")
				            {
				              document.getElementById('successtaskedit').style.display='block';				              
					     	  document.getElementById('edittaskform').reset();
					     	  setTimeout(function() {
		                      $('#successtaskedit').hide('slow');
		                      }, 4000);
				            }
				            else
				            {
					      	  document.getElementById('errortaskedit').style.display='block';
				              document.getElementById("errortaskedit").innerHTML=json.msg;
				              
				               setTimeout(function() {
				               $('#errortaskedit').hide('slow');
		                      }, 4000);
					      	
				            }
				            
				            }
					        }
					        xmlhttp.open("POST",url_path,true);
					        xmlhttp.send(formData);
					      }
                });

				//End Edit task Validaion

                $.validator.addMethod("Alphaspace", function(value, element) {
                    return this.optional(element) || /^[a-z ]+$/i.test(value);
                }, "Username must contain only letters, numbers, or dashes.");

                $.validator.addMethod("Alphanumeric", function(value, element) {
                    return this.optional(element) || /^[a-z0-9]+$/i.test(value);
                }, "Username must contain only letters, numbers, or dashes.");

                $.validator.addMethod("nowhitespace", function(value, element) {
                    return this.optional(element) || /^\S+$/i.test(value);
                }, "Space are not allowed");
                
            });


