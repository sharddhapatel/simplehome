@extends('header')
 @section('title')
Contact
@endsection
@section('content')	
<div class="container">
		<div class="row">
			<header class="row tm-welcome-section">
				<h2 class="col-12 text-center tm-section-title">Contact Page</h2>
				<p class="col-12 text-center">You may use <a rel="nofollow" href="https://www.ltcclock.com/downloads/simple-contact-form/" target="_blank">Simple Contact Form</a> to send email to your inbox. You can modify and use this template for your website. Header image has a parallax effect. Total 3 HTML pages included in this template.</p>
			</header>
		</div>
		



		<div class="tm-container-inner-2 tm-contact-section">
				<div class="row">
					<div class="col-md-6">
						<form action="{{url('insertcontact')}}" method="post" class="tm-contact-form">
							{{ csrf_field() }}
					        <div class="form-group">
					          <input type="text" name="name" class="form-control" placeholder="Name" required="" />
					        </div>
					        <br>
					        <div class="form-group">
					          <input type="email" name="email" class="form-control" placeholder="Email" required="" />
					        </div>
							<br>
					        <div class="form-group">
					          <textarea rows="5" name="message" class="form-control" placeholder="Message" required=""></textarea>
					        </div>
							<br>
					        <div class="form-group tm-d-flex">
					          <button type="Submit" id="button1id" class="tm-btn tm-btn-success tm-btn-right">Send</button>
					        </div>
						</form>
					</div>
					<div class="col-md-6">
						<div class="tm-address-box">
							<h4 class="tm-info-title tm-text-success">Our Address</h4>
							<address>
								Deep Kamal Complex, Gujarat State Highway 167, Sarthana Jakat Naka, Nature Park and Zoo, Nana Varachha, Surat, Gujarat.
							</address>
							<a href="tel:080-090-0110" class="tm-contact-link">
								<i class="fas fa-phone tm-contact-icon"></i>080-090-0110
							</a>
							<a href="mailto:info@company.co" class="tm-contact-link">
								<i class="fas fa-envelope tm-contact-icon"></i>info@company.co
							</a>
							<div class="tm-contact-social">
								<a href="https://fb.com/templatemo" class="tm-social-link"><i class="fab fa-facebook tm-social-icon"></i></a>
								<a href="https://twitter.com/LOGIN" class="tm-social-link"><i class="fab fa-twitter tm-social-icon"></i></a>
								<a href="https://www.instagram.com/accounts/login/" class="tm-social-link"><i class="fab fa-instagram tm-social-icon"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
           


<!-- How to change your own map point
	1. Go to Google Maps
	2. Click on your location point
	3. Click "Share" and choose "Embed map" tab
	4. Copy only URL and paste it within the src="" field below

	
-->
		<div class="tm-container-inner-2 tm-map-section">
				<div class="row">
					<div class="col-12">
						<div class="tm-map">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3719.067265102127!2d72.89452451562904!3d21.229181086280327!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04f600ec9a513%3A0x75e7f0f18f891b4d!2sDeepkamal%20mall%20%26%20multiplex!5e0!3m2!1sen!2sin!4v1620284821927!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
						</div>
					</div>
				</div>
			</div>


		</div>

		<script src="js/jquery.min.js"></script>
	<script src="js/parallax.min.js"></script>
	<script>
		$(document).ready(function(){
			var acc = document.getElementsByClassName("accordion");
			var i;
			
			for (i = 0; i < acc.length; i++) {
			  acc[i].addEventListener("click", function() {
			    this.classList.toggle("active");
			    var panel = this.nextElementSibling;
			    if (panel.style.maxHeight) {
			      panel.style.maxHeight = null;
			    } else {
			      panel.style.maxHeight = panel.scrollHeight + "px";
			    }
			  });
			}	
		});
	</script>

@stop