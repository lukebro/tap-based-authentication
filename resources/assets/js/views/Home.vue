<template>
<div>
	<section class="hero is-medium is-primary is-bold">
	  <div class="hero-body">
	    <div class="container">
	      <h1 class="title">
	      	Tapped-based Authentication for Mobile Device Security
	      </h1>
	      <h2 class="subtitle">
	        A proof of concept on the ability to authenticate via a tap sequence.
	      </h2>
	      <div class="control is-grouped is-block-mobile">
	      	<p class="control" style="margin-top: 1em"><a href="/Tapped-based_Authentication_for_Mobile_Device_Security.pdf" target="_blank" class="button is-primary is-inverted is-outlined is-medium"><span class="icon is-medium"><i class="fa fa-book"></i></span><span>Read the paper</span></a></p>
	      	<p class="control" style="margin-top: 1em"><router-link to="register" class="button is-primary is-inverted is-outlined is-medium"><span class="icon is-medium"><i class="fa fa-hand-pointer-0"></i></span><span>Try the demo</span></router-link></p>
	      	<p class="control" style="margin-top: 1em"><a href="/poster.pdf" target="_blank" class="button is-primary is-inverted is-outlined is-medium"><span class="icon is-medium"><i class="fa fa-file-powerpoint-o"></i></span><span>View the poster</span></a></p>
	      	<p class="control" style="margin-top: 1em"><a href="http://github.com/lukebro/tap" class="button is-primary is-inverted is-outlined is-medium"><span class="icon is-medium"><i class="fa fa-github"></i></span><span>View the code</span></a></p>
	      </div>
	    </div>
	  </div>
	</section>
	<div class="section">
		<div class="container">
			<div class="content">
				<h2 class="title">Introduction</h2>
				<ul>
					<li>Passkeys have been around since personal phones existed.</li>
					<li>A tap sequence used as a passkey offers infinite unique combinations</li>
					<li> Our results show that it is possible to authenticate using a unique tap sequence, and convenient enough to be used every day to unlock a personal device.</li>
				</ul>
				<h2 class="title">Problem</h2>
				<ul>
					<li>Current devices have only a four-digit passkey which isn't very secure.</li>
					<li>A tap sequence is a much more complex passkey.</li>
					<li>Every tap sequence can be unique for each user, unlike a traditional four-digit passkey.</li>
					<li>Tap sequence is practically impossible to brute force because their are infinite possibilities.</li>
				</ul>
				<h2 class="title">Background</h2>
				<ul>
					<li>TapSongs [2] first introduced the idea of a tap sequence being used for authentication in 2009.</li>
					<li>A tap sequence is a set of timestamps recorded by an application.</li>
					<li>Minimum requirements for tap authentication include the relative timestamps of the up/down presses [1].</li>
					<li>The sequence can be made more complex by adding coordinates, pressure or area.</li>
					<li>To compare the tap sequence vectors the Hamming distance can be used.</li>
					<li>Hamming distances measures the minimum number of substations required to change one vector to another [3].</li>
					<li>We used a variation of the Euclidean distance which is the sum of squares of data sets for each vector.</li>
					<li>Our algorithm also took into account standard deviation which allows for margin of error when entering a passkey.</li>
					<li>Based on a calculated dissimilarity score, we can decide whether the correct sequence was entered.</li>
				</ul>
				<h2 class="title">Approach</h2>
				<ul>
					<li>The first prototype on an Android device was implemented.</li>
					<li>The application let us test the capability of mobile devices and their ability to run the algorithm quickly.</li>
					<li>This prototype allowed us to verify the practicality and usability of this approach of authentication.</li>
					<li>Since only two tap sequences need to be compared (key and attempt), this is a very fast feedback loop.</li>
					<li>The approach is unique because every single passkey is distinct due to micro variations.</li>
				</ul>
				<h2 class="title">Results</h2>
				<ul>
					<li>Tap sequences are extremely hard to replicate.</li>
					<li>Can be made easier by only comparing intervals of presses.</li>
					<li>This was demoed by the web application (this).</li>
					<li>This allows us to match the sequences reliably while keeping a reasonable acceptance rate.</li>
					<li>The algorithm returns a dissimilarity score which indicates how close the master and trial sequences are.</li>
					<li>It was found that more complex patterns were more secure while still being relatively easy for the user to replicate.</li>
					<li>The next step was to start recording statistics to better improve acceptance rate by tweaking the algorithm or the acceptance score.</li>
					<li>After many tweaks, a tap sequence proves to be a reliable way of verification for the average user.</li>
				</ul>
				<h2 class="title">References</h2>
				<ol style="list-style: none">
					<li>[1] Marques, D., Guerreiro, T., Duarte, L., Carriço, L. (2013). Under the table: tap authentication for smartphones. In Proc. of BCS HCI '13, Swinton, UK</li>
					<li>[2] Wobbrock, J.O. (2009). TapSongs: tapping rhythm-based passwords on a single binary sensor. In: Proc. UIST '09. ACM Press. 93-96.</li>
					<li>[3] Norouzi, M., Fleet, D. J., & Salakhutdinov, R. (2012). Hamming Distance Metric Learning. Advances in Neural Information Processing Systems 25, 1-9.</li>
				</ol>
			</div>
		</div>
	</div>
	<footer class="footer">
	  <div class="container">
	    <div class="content has-text-centered">
	      <p>
	        Research and study by <a href="mailto:brodowski@my.ccsu.edu">Lukasz Brodowski</a>, Cameron Dziurgot and Donald Moretz.
	      </p>
	      <p>
			Faculty Advisor: <a href="mailto:kurkovsky@ccsu.edu">Stan Kurkovsky</a>, Ph.D. - Professor and Chair of Computer Science @ <a href="http://ccsu.edu">CCSU</a>.
	      </p>
	    </div>
	  </div>
	</footer>
</div>
</template>
