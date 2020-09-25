<?php $this->load->view('home/header'); ?>
<link href="<?php echo base_url();?>public/css/hotel_result.css" rel="stylesheet">
<link href="<?php echo base_url();?>public/css/hotel_details.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url() ?>public/vendor/grid_gallery/images-grid.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/vendor/paxdrop/paxdrop.css">

<?php
  $hotel_search_data = $this->Hotels_Model->check_hotel_search_data($ses_id,$refNo);

  $search_data=json_decode($hotel_search_data->search_data,true);
  // echo '<pre>';print_r($search_data);//exit;
  $infant=isset($search_data['infant'])?$search_data['infant']:'0';
  $cityName=isset($search_data['cityName'])?$search_data['cityName']:'';
  $cityCode=isset($search_data['cityCode'])?$search_data['cityCode']:'';
  $nationality=isset($search_data['nationality'])?$search_data['nationality']:'';
  $checkIn=isset($search_data['checkIn'])?$search_data['checkIn']:'';
  $checkOut=isset($search_data['checkOut'])?$search_data['checkOut']:'';
  $rooms = isset($search_data['rooms'])?$search_data['rooms']:1;
  $adults=isset($search_data['adults'][0])?$search_data['adults'][0]:1;
  $childs=isset($search_data['childs'][0])?$search_data['childs'][0]:0;
  $childs_ages=isset($search_data['childs_ages'][0])?$search_data['childs_ages'][0]:'';
  $adults_count=$search_data['adults_count'];
  $childs_count=$search_data['childs_count'];
  $ages=array();
  $noOfPassengers = $adults+$childs;
  if ($childs != 0) {
    $ages = explode(',', $childs_ages);
  }
  // echo "<pre> 132"; print_r($hotelDetails);exit;
  $star = $hotelDetails->hotel_star_rating;
  // $similar_data = $this->Hotels_Model->all_fetch_search_result($ses_id, $offset = 0, 2,'','',$star);
  
  $similar_data = '';
  if(!empty($hotelDetails)) {
    $similar_data = $this->Hotels_Model->get_nearby_hotels($ses_id,$hotelDetails->hotel_code,$hotelDetails->latitude,$hotelDetails->longitude,$hotelDetails->city_name);
      // echo $this->db->last_query();
      // echo "<pre> 132"; print_r($similar_data);exit;
  }
  
  if(!empty($hotelDetails->amenities)) {
    $amenities = explode(',', $hotelDetails->amenities);
    $hotels_amenities = $this->Hotels_Model->get_hotel_crs_amenities($amenities);
    $general_amenities = '';
    $Gym = $Parking = $Swimming = $WiFi = $Smoking = $PetsAllowed ='inactive';
    $Accessible = $BusinessCenter = $Breakfast = $AirportShuttle = 'inactive';
    for($k=0;$k<count($hotels_amenities);$k++){
      if(!empty($hotels_amenities[$k])){
        $general_amenities .= '<li><span class="fa fa-check"></span> '.$hotels_amenities[$k]->facility.'</li>';
        if($hotels_amenities[$k]->facility=='Gym') {
          $Gym = 'active';
        }
        if($hotels_amenities[$k]->facility=='Parking') {
          $Parking = 'active';
        }
        if($hotels_amenities[$k]->facility=='Wifi') {
          $WiFi = 'active';
        }
        if($hotels_amenities[$k]->facility=='Swimming') {
          $Swimming = 'active';
        }
        if($hotels_amenities[$k]->facility=='Smoking') {
          $Smoking = 'active';
        }
        if($hotels_amenities[$k]->facility=='Accessible') {
          $Accessible = 'active';
        }
        if($hotels_amenities[$k]->facility=='BusinessCenter') {
          $BusinessCenter = 'active';
        }
        if($hotels_amenities[$k]->facility=='Breakfast') {
          $Breakfast = 'active';
        }
        if($hotels_amenities[$k]->facility=='AirportShuttle') {
          $AirportShuttle = 'active';
        }
        if($hotels_amenities[$k]->facility=='PetsAllowed') {
          $PetsAllowed = 'active';
        }
      }
    }
  }

  // echo "<pre> 132"; print_r($hotelDetails);exit;
?>
<div class="content white-container">
  <section class="push-top-20">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="form_wizard wizard_horizontal">
            <ul class="wizard_steps">
              <li class="active_step">
                <a href="javascript:;">
                  <span class="step_no wizard-step">1</span>
                  <span class="step_descr">Choose your rooms</span>
                </a>
              </li>
              <li>
                <a href="javascript:;">
                  <span class="step_no wizard-step">2</span>
                  <span class="step_descr">Enter your details</span>
                </a>
              </li>
              <li>
                <a href="javascript:;">
                  <span class="step_no wizard-step">3</span>
                  <span class="step_descr">Secure your booking</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="hotel-details-section" class="push-top-20 hotel-details-section">
    <div class="container">
      <div class="row no-padding">
        <div class="col-md-7">
          <div class="hotel-details">
            <h3><?php echo $hotelDetails->hotel_name//.', '.$hotelDetails->city_name;  ?> <span class="star star<?php echo $star  ?>"></span></h3>
            <small>Neighborhood: <b><?php echo $hotelDetails->location;  ?></b> | <?php echo $hotelDetails->address;  ?>, <?php echo $hotelDetails->city_name;  ?> | <a href="javascript:;" class="maps ajax-tabs" data-id="map"><i class="fa fa-map-marker"></i> <u>View Map</u></a></small>
          </div>
          <div class="row2 ajax-tab-content ajax-content" style="display: none;">
            <div class="loaddiv" style="display: none;">
              <div class='row2' id='loading' style='text-align: center;padding: 30px 0;'>
                <div id='loader' style='position: static;margin: auto;'></div>
              </div>
            </div>
            <div class="resultdiv"></div>
            <div class="mapdiv" style="display: none;">
              <iframe src = "https://maps.google.com/maps?q=<?php  echo $hotelDetails->latitude;?>,<?php  echo $hotelDetails->longitude;?>&hl=es;z=14&amp;output=embed" width="100%" height="180" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="price-details">
            <a id="jump_rooms2" href="#htl-rooms" class="btn book-btn">Choose a Room <span class="fa fa-caret-down"></span></a>
          </div>

          <div class="price-details">
            <h2 class="price-tag">
              <?php if($hotelDetails->discount > 0) { ?>
              <span style="text-decoration: line-through;position: absolute;left: 190px;top: 12px;color: #999;"><i class="fa fa-dollar" style="color: #999;"></i><span><?php echo (($total_cost + $hotelDetails->discount)/$search_data['nights']); ?></span></span>
              <?php } ?>
              <small>from </small>
              <i class="fa fa-dollar"></i><span><?php echo ($total_cost/$search_data['nights']); ?></span>
              <small>USD</small>
              <small>Per Night</small>
            </h2>
          </div>
        </div>
      </div>
      <div class="white-box row2 gallary-details">
        <div class="row">
          <div class="container fixed-tab">
            <div class="row">
              <div class="col-md-12">
                <div class="ajax-tab text-left">
                  <ul>
                    <li><a class="active" href="#htl-rooms">Rooms &amp; Rates</a></li>
                    <li><a href="#htl-desc">Hotel Description</a></li>
                    <!-- <li><a href="#htl-reviews">Reviews</a></li> -->
                    <li><a href="#htl-amenities">Amenities</a></li>
                    <li><a href="#htl-reviews">Verified Guest Reviews</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-7">
            <div id="gallery-div" class="imgs-grid imgs-grid-7"></div>
          </div>
          <div class="col-md-5 right-sec">
            <!-- <div class="row2">
              <div class="row2 review-details text-left">
                <div class="grey-details">
                  <div>
                    <span>Excellent</span>
                    <small><i class="star star4"></i></small>
                  </div>
                  <div>
                    <span class="help-tip">8.1<div>Very Good</div></span>
                  </div>
                </div>
                <div class="grey-details">
                  15,498 verified reviews
                </div>
              </div>
            </div> -->
            <div class="row2 htl-review push-top-20">
              <p>
                <i class="fa fa-comments"></i>
                <emp><i>"Location and exterior decor"</i></emp>&nbsp;
                <a class="blue-link" id="jump_reviews2" href="#htl-reviews" title="Click to see the full review"> <u>More Ratings</u></a>
              </p>
            </div>
            <hr>
            <div class="row2 promos">
              <h3><i class="fa fa-tag"></i> Promos Available</h3>
              <p>See <a id="jump_rooms2" class="blue-link" href="#htl-rooms"> <u>Room and Rates</u></a> for more details</p>
            </div>
            <hr>
            <div class="row2 promos">
              <p><b>Featured Amenities <a id="jump_amenities2" class="blue-link" href="#htl-amenities"> <u>View More</u></a></b></p>
              <ul class="htl-amenities">
                <?php if($Gym == 'active'){ ?>
                <li class="active">
                  <button type="button" class="feature-btn"><img src="<?php echo base_url() ?>public/images/icons/gym.svg"></button>
                  <label class="control-label feature-label">Fitness Center</label>
                </li>
                <?php } ?>
                <?php if($Smoking == 'active'){ ?>
                <li class="active">
                  <button type="button" class="feature-btn"><img src="<?php echo base_url() ?>public/images/icons/smoking.svg"></button>
                  <label class="control-label feature-label">Non Smoking</label>
                </li>
                <?php } ?>
                <?php if($Accessible == 'active'){ ?>
                <li class="active">
                  <button type="button" class="feature-btn"><img src="<?php echo base_url() ?>public/images/icons/handicapped.svg"></button>
                  <label class="control-label feature-label">Accessible</label>
                </li>
                <?php } ?>
                <?php if($BusinessCenter == 'active'){ ?>
                <li class="active">
                  <button type="button" class="feature-btn"><span class="fa fa-briefcase"></span></button>
                  <label class="control-label feature-label">Business Center</label>
                </li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="push-top-20 detail-content row2">
        <div id="htl-rooms" class="room-details row2">
          <h3 class="accordions-heading">Rooms &amp; Rates <small>(<?php echo  $search_data['nights']; ?> nights: <?php echo $checkIn;?> - <?php echo $checkOut;?>) <!-- <a href="javascript:;" class="blue-link modifySearch">Change Dates</a> --></small><!--  <span class="fa fa-angle-down pull-right"></span> --></h3>
          <div class="accordions-content">
            <div id="reservation-form" class="change-rooms" style="display: block;">
              <form action="<?php echo site_url().'hotels/hotelroomdetails/'.base64_encode($ses_id.'/'.$refNo.'/'.$searchId.'/'.$hotelDetails->hotel_code.'/'. base64_encode('hotel_crs')); ?>" class="tab-pane form-inline active"  method="post" name="reservationform">
                <div class="row no-padding">
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label for="dph5">Check-In</label>
                      <input name="checkIn" type="text" value="<?php echo $checkIn;?>" class="form-control" placeholder="Check-In" id="dph5" autocomplete="off" readonly style="background: #fff;cursor: pointer;">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="row no-padding">
                      <div class="col-md-9">
                        <div class="form-group">
                          <label for="dph6">Check-Out</label>
                          <input name="checkOut" type="text" value="<?php echo $checkOut;?>" class="form-control" placeholder="Check-Out"  id="dph6" autocomplete="off" readonly style="background: #fff;cursor: pointer;">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="invisible" id="datadiffnight" data-val="Night"> <?php echo  $search_data['nights']; ?> Night</label>
                          <input name="night" id="datadiff" type="text" value="<?php echo  $search_data['nights']; ?> Night" class="form-control" autocomplete="off" style="background: transparent;border: none;box-shadow: none;cursor: default;padding: 0;margin: 0;text-align: center;" readonly="">
                          <input type="hidden" name="results_id" value="<?php echo base64_encode($this->session->session_id.'/'.$newuniqueRefNo.'/'.''.'/'.$hotelDetails->hotel_code.'/'. base64_encode('hotel_crs').'/'.$city_code); ?>">
                          <input type="hidden" name="nationality" value="<?php echo $nationality; ?>">
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- <div class="col-sm-3">
                    <div class="row no-padding">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="rooms">Rooms</label>
                          <select class="form-control" name="room_count" id="rooms">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="adult">Adult</label>
                          <select class="form-control" name="adults[]" id="adult">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="child">Children</label>
                          <select class="form-control" name="childs[]" id="child">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div> -->
                  <div class="col-md-3 col-sm-4 pax_drop">
                    <div class="form-group">
                      <label class="control-label pax_label">No of Guests</label>
                      <span class="form-control c-round c-theme travellers-input" id="travellers-hotel" style="line-height: 24px;">
                        <span class="adultsF travellers-input"><?php echo $adults_count ?></span> adult,
                        <span class="childsF travellers-input"><?php echo $childs_count ?></span>  child,
                        <span class="room_countF travellers-input"><?php echo $rooms ?></span>  room
                      </span>
                    </div>
                    <div class="travellers-input-popup" id="travellers-hotel-popup">
                      <i class="fa fa-times" aria-hidden="true"></i>
                      <div class="trip-options">
                        <p>Room - <span>1</span></p>
                        <div class="numstepper small-btns">
                          <button type="button" class="quantity-btn quantity-left-minus btn-number-rooms"  data-type="minus" data-field="room_count"></button>
                          <input type="text" name="room_count" class="quantity-input input-number multi" value="<?php echo $rooms ?>" min="1" max="4">
                          <button type="button" class="quantity-btn quantity-right-plus btn-number-rooms" data-type="plus" data-field="room_count"></button>
                        </div>
                        <div class="clone-room">
                          <p class="rooms" style="display: none;">Room - <span>2</span></p>
                          <div class="numstepper small-btns">
                            <p>Adults</p>
                            <button type="button" class="quantity-btn quantity-left-minus btn-number-arr" data-type="minus" data-field="adults">
                            </button>
                            <input type="text" name="adults[]" class="quantity-input input-number adults" value="<?php echo $adults ?>" min="1" max="3">
                            <button type="button" class="quantity-btn quantity-right-plus btn-number-arr" data-type="plus" data-field="adults">
                            </button>
                          </div>
                          <div class="clone-item roomage">
                            <input type="hidden" class="roomsno" value="1">
                            <p style="display: none;">Child Age - <span>1</span></p>
                            <div class="numstepper small-btns">
                              <p>Children</p>
                              <button type="button" class="quantity-btn quantity-left-minus btn-number-multi roomAge" data-type="minus" data-field="childs">
                              </button>
                              <input type="text" name="childs[]" class="quantity-input input-number multi childs" value="<?php echo $childs ?>" min="0" max="3">
                              <button type="button" class="quantity-btn quantity-right-plus btn-number-multi roomAge" data-type="plus" data-field="childs">
                              </button>
                            </div>
                          </div>
                          <div class="clonediv">
                            <?php if($search_data['childs'][0] > 0){ ?>
                            <?php $chAge = explode(',', $childs_ages[0]) ?>
                            <?php //echo '<pre>';print_r($chAge) ?>
                            <?php for($ch=0;$ch<count($chAge);$ch++){ ?>
                            <div class="clone-item roomage" id="clone-<?php echo $ch+1 ?>">
                              <input type="hidden" class="roomsno" value="1">
                              <p style="display: block;">Child Age - <span><?php echo $ch+1 ?></span></p>
                              <div class="numstepper small-btns">
                                <p style="display: none;">Children</p>
                                <button type="button" class="quantity-btn quantity-left-minus btn-number-arr2" data-type="minus" data-field="input-array">
                                </button>
                                <input type="text" name="childs_ages_room1[]" class="quantity-input input-number input-array" value="<?php echo $chAge[$ch] ?>" min="2" max="11" data-field="input-array">
                                <button type="button" class="quantity-btn quantity-right-plus btn-number-arr2" data-type="plus" data-field="input-array">
                                </button>
                              </div>
                            </div>
                            <?php } ?>
                            <?php } ?>
                          </div>
                        </div>
                        <div class="clonediv-room">
                          <?php if($rooms > 1){ ?>
                          <?php for($r=1;$r<$rooms;$r++){ ?>
                          <div class="clone-room" id="clone-room-<?php echo $r+1 ?>">
                            <p class="rooms" style="display: block;">Room - <span><?php echo $r+1 ?></span></p>
                            <div class="numstepper small-btns">
                              <p>Adults</p>
                              <button type="button" class="quantity-btn quantity-left-minus btn-number-arr" data-type="minus" data-field="adults">
                              </button>
                              <input type="text" name="adults[]" class="quantity-input input-number adults" value="<?php echo $search_data['adults'][$r] ?>" min="1" max="3">
                              <button type="button" class="quantity-btn quantity-right-plus btn-number-arr" data-type="plus" data-field="adults">
                              </button>
                            </div> 
                            <div class="clone-item roomage">
                              <input type="hidden" class="roomsno" value="<?php echo $r+1 ?>">
                              <p style="display: none;">Child Age - <span>1</span></p>
                              <div class="numstepper small-btns">
                                <p>Children</p>
                                <button type="button" class="quantity-btn quantity-left-minus btn-number-multi roomAge" data-type="minus" data-field="childs">
                                </button>
                                <input type="text" name="childs[]" class="quantity-input input-number multi childs" value="<?php echo $search_data['childs'][$r] ?>" min="0" max="3">
                                <button type="button" class="quantity-btn quantity-right-plus btn-number-multi roomAge" data-type="plus" data-field="childs">
                                </button>
                              </div>
                            </div>
                            <div class="clonediv">
                              <?php if($search_data['childs'][$r] > 0){ ?>
                              <?php $chAge2 = explode(',', $search_data['childs_ages'][$r]) ?>
                              <?php for($ch2=0;$ch2<count($chAge2);$ch2++){ ?>
                              <div class="clone-item roomage" id="clone-<?php echo $ch2+1 ?>">
                                <input type="hidden" class="roomsno" value="2">
                                <p style="display: block;">Child Age - <span><?php echo $ch2+1 ?></span></p>
                                <div class="numstepper small-btns">
                                  <p style="display: none;">Children</p>
                                  <button type="button" class="quantity-btn quantity-left-minus btn-number-arr2" data-type="minus" data-field="input-array">
                                  </button>
                                  <input type="text" name="childs_ages_room<?php echo $r+1 ?>[]" class="quantity-input input-number input-array" value="<?php echo $chAge2[$ch2] ?>" min="2" max="11" data-field="input-array">
                                  <button type="button" class="quantity-btn quantity-right-plus btn-number-arr2" data-type="plus" data-field="input-array">
                                  </button>
                                </div>
                              </div>
                              <?php } ?>
                              <?php } ?>
                            </div>
                          </div>
                          <?php } ?>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-1">
                    <div class="form-group">
                      <label class="invisible" style="width: 100%">Update</label>
                      <button class="btn btn-custom">Update</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="rm-rates push-top-10">
              <h3>Available Rooms</h3>
              <div id="rooms_info">
                <?php $this->load->view('rooms_available'); ?>
              </div>
            </div>
          </div>
        </div>
        <div id="htl-desc" class="row2">
          <h3 class="accordions-heading">Hotel Description <span class="fa fa-angle-down pull-right"></span></h3>
          <div class="white-box accordions-content">
            <div class="row">
              <div class="col-md-12">
                <p><?php  echo strip_tags(html_entity_decode($hotelDetails->description));?></p>
              </div>
              <!-- <div class="col-md-3">
                <div class="why-us">
                  <h5>Why Booking with us?</h5>
                  <ul>
                    <li><i class="fa fa-check"></i> Low Rates</li>
                    <li><i class="fa fa-check"></i> <b>Verified</b> Guest Reviews</li>
                    <li><i class="fa fa-check"></i> Largest Selection</li>
                  </ul>
                </div>
              </div> -->
            </div>
          </div>
        </div>
        <div id="htl-amenities" class="row2">
          <h3 class="accordions-heading">Amenities <span class="fa fa-angle-down pull-right"></span></h3>
          <div class="white-box accordions-content">
            <?php if(!empty($hotelDetails->amenities)) { ?>
            <div class="row">
              <div class="col-md-12 feature-list">
                <ul>
                  <li class="<?php echo $Gym ?>">
                    <button type="button" class="feature-btn"><img src="<?php echo base_url() ?>public/images/icons/gym.svg"></button>
                    <label class="control-label feature-label">Fitness Center</label>
                  </li>
                  <li class="<?php echo $Smoking ?>">
                    <button type="button" class="feature-btn"><img src="<?php echo base_url() ?>public/images/icons/smoking.svg"></button>
                    <label class="control-label feature-label">Non Smoking</label>
                  </li>
                  <li class="<?php echo $Accessible ?>">
                    <button type="button" class="feature-btn"><img src="<?php echo base_url() ?>public/images/icons/handicapped.svg"></button>
                    <label class="control-label feature-label">Accessible</label>
                  </li>
                  <li class="<?php echo $BusinessCenter ?>">
                    <button type="button" class="feature-btn"><span class="fa fa-briefcase"></span></button>
                    <label class="control-label feature-label">Business Center</label>
                  </li>
                  <li class="<?php echo $Breakfast ?>">
                    <button type="button" class="feature-btn"><span class="fa fa-coffee"></span></button>
                    <label class="control-label feature-label">Free Breakfast</label>
                  </li>
                  <li class="<?php echo $Parking ?>">
                    <button type="button" class="feature-btn"><img src="<?php echo base_url() ?>public/images/icons/parking.svg"></button>
                    <label class="control-label feature-label">Free Parking</label>
                  </li>
                  <li class="<?php echo $AirportShuttle ?>">
                    <button type="button" class="feature-btn"><img src="<?php echo base_url() ?>public/images/icons/airportshuttle.svg"></button>
                    <label class="control-label feature-label">Free Airport Shuttle</label>
                  </li>
                  <li class="<?php echo $WiFi ?>">
                    <button type="button" class="feature-btn"><img src="<?php echo base_url() ?>public/images/icons/wifi.svg"></button>
                    <label class="control-label feature-label">Free Internet</label>
                  </li>
                  <li class="<?php echo $Swimming ?>">
                    <button type="button" class="feature-btn"><img src="<?php echo base_url() ?>public/images/icons/swimming.svg"></button>
                    <label class="control-label feature-label">Swimming Pool</label>
                  </li>
                  <li class="<?php echo $PetsAllowed ?>">
                    <button type="button" class="feature-btn"><img src="<?php echo base_url() ?>public/images/icons/petfriendly.svg"></button>
                    <label class="control-label feature-label">Pets allowed</label>
                  </li>
                </ul>
              </div>
            </div>
            <?php } ?>
            <div class="push-top-10 hotel-dtls-amenities">
              <h4>All Amenities</h4>
              <div class="row push-top-20">
                <div class="col-md-12">
                  <ul>
                    <?php echo $general_amenities; ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="htl-reviews" class="row2">
          <h3 class="accordions-heading">Guest Ratings <span class="fa fa-angle-down pull-right"></span></h3>
          <div class="white-box accordions-content">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam quos laboriosam eius, fugiat praesentium omnis perspiciatis nesciunt cumque at. At fugit omnis non iure dolor inventore repellat obcaecati, officiis esse.
          </div>
        </div>
        <div id="htl-info" class="row2">
          <h3 class="accordions-heading">Important Information<span class="fa fa-angle-down pull-right"></span></h3>
          <div class="white-box accordions-content">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim, ea libero odit ipsum, quisquam saepe dolor quibusdam nobis harum vel, minima, sit numquam cum doloremque dicta. Unde ut maxime deserunt! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore, incidunt, reiciendis? Voluptas, deserunt nihil consequatur minima provident! Cupiditate amet dignissimos repellendus maxime laboriosam qui atque tenetur enim, ratione illum, commodi. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim, ea libero odit ipsum, quisquam saepe dolor quibusdam nobis harum vel, minima, sit numquam cum doloremque dicta. Unde ut maxime deserunt! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore, incidunt, reiciendis? Voluptas, deserunt nihil consequatur minima provident! Cupiditate amet dignissimos repellendus maxime laboriosam qui atque tenetur enim, ratione illum, commodi.</p>
          </div>
        </div>
        <div id="htl-nearby" class="row2">
          <h3 class="accordions-heading">Nearby Hotels<span class="fa fa-angle-down pull-right"></span></h3>
          <div class="white-box accordions-content nearby grid-view" id="nearby-property">
            <?php if(!empty($similar_data)) { ?>
            <?php for($s=0;$s<count($similar_data);$s++){ ?>
            <div class="result-grid hotel-grid result-box nearby-box">
              <div class="row left-section">
                <div class="col-sm-12">
                  <div class="htl-img">
                    <img src="<?php echo base_url().'supplier/'.$similar_data[$s]->thumb ?>" alt="<?php echo $similar_data[$s]->hotel_name ?>" class="img-responsive" />
                  </div>
                </div>
              </div>
              <div class="row no-padding right-section">
                <div class="col-sm-12">
                  <div class="grid-content">
                    <div class="row2 result-details">
                      <h3><?php echo $similar_data[$s]->hotel_name ?> <span class="star star<?php echo $similar_data[$s]->star ?>"></span></h3>
                    </div>
                    <div class="row2">
                      <ul class="description">
                        <li><i class="fa fa-comments"></i> Okay, 5.5/10 <a href="javascript:;" class="rating ajax-tabs blue-link" data-id="rating"><u>51 Ratings</u></a></li>
                        <li><i class="fa fa-map-marker"></i> <?php echo $similar_data[$s]->address ?></li>
                        <!-- <li>Latest Booking: 29 days 21 hours ago</li> -->
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row no-padding right-section">
                <div class="col-sm-12">
                  <a href="<?php echo site_url().'hotels/details/'.base64_encode($ses_id.'/'.$refNo.'/'.$similar_data[$s]->search_id.'/'.$similar_data[$s]->hotel_code.'/'. base64_encode('hotel_crs')); ?>"  class="btn blue-btn form-control radius-two">Show Prices</a>
                </div>
              </div>
            </div>
            <?php } } else { ?>
            <h4>No nearby hotels found</h4>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<a href="#" id="back-top" title="Back To Top" class=""></a>
</body>
<?php $this->load->view('home/footer');?>
<script src="<?php echo base_url();?>public/vendor/grid_gallery/images-grid.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/vendor/paxdrop/paxdrop.js"></script>
<script type="text/javascript">
  var nearbyBox = $('#nearby-property').find('.nearby-box');
  var nearbyCount = nearbyBox.length;
  console.log(nearbyCount);
  if(nearbyCount == 1 || nearbyCount == 2){
    nearbyBox.parent().css('justify-content', 'left');
  }
</script>
<script>
  $(document).ready(function () {
    $('.accordions-heading span').each(function () {
      var $this = $(this).parent();
      $(this).click(function () {
        if ($this.next('.accordions-content').is(':visible')) {
          $this.next('.accordions-content').slideUp('slow');
          $this.find('span').removeClass('fa-angle-down').addClass('fa-angle-right');
        } else {
          $this.next('.accordions-content').slideDown('slow');
          $this.find('span').removeClass('fa-angle-right').addClass('fa-angle-down');
        }
      });
    });
  });
</script>
<script type="text/javascript">
  var header = $(".fixed-tab");
  var posFromTop = header.offset().top;

  $(window).on("scroll", function(e) {
    var scrollTop = $(window).scrollTop();
    if(scrollTop > posFromTop) {
      header.addClass("fixed");
      $('.detail-content').addClass("fixed");
    } else {
      header.removeClass("fixed");
      $('.detail-content').removeClass("fixed");
    }
  });
</script>

<script type="text/javascript">
  $(document).ready(function () {
      $(document).on("scroll", onScroll);
      //smoothscroll
      $('.ajax-tab a[href^="#"], #jump_rooms2,#jump_reviews2,#jump_amenities2').on('click', function (e) {
          e.preventDefault();
          $(document).off("scroll");
          
          $('.ajax-tab a').each(function () {
              $(this).removeClass('active');
          })
          $(this).addClass('active');
        
          var target = this.hash;
          $target = $(target);
          $('html, body').stop().animate({
              'scrollTop': $target.offset().top
          }, 600, 'linear', function () {
              window.location.hash = target;
              $(document).on("scroll", onScroll);
          });
      });
  });

  function onScroll(event){
    var scrollPos = $(document).scrollTop();
    $('.ajax-tab a').each(function () {
      var currLink = $(this);
      var refElement = $(currLink.attr("href"));
      var headerheight = $(".fixed-tab").height()+35;
      if (refElement.position().top - headerheight <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
          $('.ajax-tab ul li a').removeClass("active");
          currLink.addClass("active");
      }
      else{
          // currLink.removeClass("active");
      }
    });
  }
</script>

<script type="text/javascript">
  $('.modifySearch').on('click', function(){
    $('#reservation-form').slideToggle();
  })
</script>
<?php if($hotelImages != '') { ?>
<script>
  var images = [
    <?php for($g=0;$g<count($hotelImages);$g++) { ?>
      '<?php echo base_url().'supplier/'.$hotelImages[$g]->gallery_img ?>',
    <?php }  ?>
  ];
  // console.log(images);

  $(function() {
      $('#gallery-div').imagesGrid({
          images: images,
          align: false,
          // getViewAllText: function(imgsCount) { return 'View All '+imgsCount+' Photos' }
      });
  });
</script>
<?php  } ?>

<script type="text/javascript">
  $(document).ready(function() {
    $(".ajax-tabs").click(function() {
      $(".resultdiv").html('');
      var $html2 ='';
      var $this = $(this);
      var $dataId = $(this).attr('data-id');
      if($dataId == 'map') {
        $html2 = $('.mapdiv').html();
        $(".ajax-tabs").not('.maps').removeClass('active');
      }else{
        $html2 = '';
        $(".resultdiv").html('');
        $(".ajax-tabs").removeClass('active');
        return false;
      }
      // console.log($dataId);

      // $("#loaddiv").show();
      $(".ajax-content").hide();
      $(this).toggleClass('active');

      if($(this).hasClass('active')){
        $.ajax({
          // url: 'this.href',
          beforeSend: function() {
            $(".loaddiv").show();
          },
          success: function(html) {
            // console.log($(this));
            $(".loaddiv").hide();
            $this.parent().parent().parent().find(".ajax-content").show();
            $(".resultdiv").html($html2);
          }
        });
      }
      return false;
    });
  });
</script>

</html>

