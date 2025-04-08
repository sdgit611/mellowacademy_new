@extends('front.layout')
@section('content')

    <section class="about pt-4 pt-lg-5">

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    foreach($license as $clic) { ?>
                    <h4><?php echo $clic->heading; ?></h4>
                    <p><?php echo $clic->description; ?></p>
                    
                    <?php
                    } ?> 
                </div>
            </div>
        </div>
    </section>
    
@endsection