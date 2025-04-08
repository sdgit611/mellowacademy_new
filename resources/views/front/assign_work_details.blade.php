@extends('front.layout')
@section('content')



            <div class="container bootstrap snippets bootdeys pt-0">
              <?php 
                foreach ($developer_resource as $resource) {
                 
              ?>
                <div class="row" id="user-profile">
                  
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="main-box clearfix">
                                <div class="profile-header">
                                    <h3><span>Developer Information</span></h3>
                                    
                                </div>

                                <div class="row profile-user-info">
                                    <div class="col-sm-8">
                                        <div class="profile-user-details clearfix">
                                            <div class="profile-user-details-label">
                                                First Name
                                            </div>
                                            <div class="profile-user-details-value">
                                                <?php echo $resource->name; ?>
                                            </div>
                                        </div>

                                        <div class="profile-user-details clearfix">
                                            <div class="profile-user-details-label">
                                                Last Name
                                            </div>
                                            <div class="profile-user-details-value">
                                                <?php echo $resource->last_name; ?>
                                            </div>
                                        </div>
                                        
                                        <!--<div class="profile-user-details clearfix">-->
                                        <!--    <div class="profile-user-details-label">-->
                                        <!--        Address-->
                                        <!--    </div>-->
                                        <!--    <div class="profile-user-details-value">-->
                                        <!--        < ?php echo $resource->address; ?>-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                    <!--    <div class="profile-user-details clearfix">-->
                                    <!--        <div class="profile-user-details-label">-->
                                    <!--            Email-->
                                    <!--        </div>-->
                                    <!--        <div class="profile-user-details-value">-->
                                    <!--           < ?php echo $resource->email; ?>-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--    <div class="profile-user-details clearfix">-->
                                    <!--        <div class="profile-user-details-label">-->
                                    <!--            Phone-->
                                    <!--        </div>-->
                                    <!--        <div class="profile-user-details-value">-->
                                    <!--            < ?php echo $resource->phone; ?>-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                  
                                </div>

                                <div class="tabs-wrapper profile-tabs">
                                    <ul class="nav nav-tabs">
                                        <li><a href="#tab-activity" data-toggle="tab">Require Docs</a></li>
                                        <li><a href="#tab-friends" data-toggle="tab">Short Message</a></li>
                                        <li><a href="#tab-chat" data-toggle="tab">SOW</a></li>
                                    </ul>

                                    <div class="tab-content">
                                        
                                        <div class="tab-pane fade in active show" id="tab-activity">
                                            <ul class="widget-users row">
                                                <?php
                                                    foreach ($require_docs_details as $require) {
                                                        
                                                ?>
                                                    <li class="col-md-6">
                                                        <div class="details">
                                                            <div class="name">
                                                                <a href="#"><?php echo $require->subject; ?> </a>
                                                            </div>
                                                            <div class="time">
                                                                <i class="fa fa-clock-o"></i> <?php echo $require->date; ?>
                                                            </div>
                                                            <div class="type">
                                                                <a href="{{route('require_docs_download', $require->id )}}" type="button" class="btn btn-primary"><i class="fa fa-download"></i> Download</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php } ?>

                                            </ul>
                                        </div>

                                        <div class="tab-pane fade" id="tab-friends">
                                           <div class="conversation-wrapper">
                                                <div class="conversation-content">
                                                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 340px;">
                                                        <div class="conversation-inner" style="overflow: hidden; width: auto; height: 340px;">

                                                            <?php 
                                                                foreach ($short_message_details as $short) { ?>
                                                            
                                                                <div class="conversation-item item-right clearfix">
                                                                    
                                                                    <div class="conversation-body">
                                                                        <div class="name">
                                                                           <?php echo $short->subject; ?>
                                                                        </div>
                                                                        <div class="time hidden-xs">
                                                                            <?php echo $short->date; ?>
                                                                        </div>
                                                                        <div class="text">
                                                                             <?php echo $short->description; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            
                                                            <?php } ?>

                                                        </div>
                                                        <div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; background: rgb(0, 0, 0);"></div>
                                                        <div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                           
                                        </div>

                                        <div class="tab-pane fade" id="tab-chat">
                                            <ul class="widget-users row">
                                                <?php
                                                    foreach ($sow_details as $sow) {
                                                        
                                                ?>
                                                    <li class="col-md-6">
                                                        <div class="details">
                                                            <div class="name">
                                                                <a href="#"><?php echo $sow->subject; ?> </a>
                                                            </div>
                                                            <div class="time">
                                                                <i class="fa fa-clock-o"></i> <?php echo $sow->date; ?>
                                                            </div>
                                                            <div class="type">
                                                                <a href="{{route('sow_docs_download', $sow->id )}}" type="button" class="btn btn-primary"><i class="fa fa-download"></i> Download</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php } ?>

                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    
                </div>
              <?php } ?>
            </div>

 
          
@endsection