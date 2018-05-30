<template>
  <main class="slim-container">
    <section>
      <!-- sample post using all typography elements -->
      <h3>Sample post using all typography elements</h3>
      <article>
        <h1>H1 Venenatis Condimentum Euismod Sit</h1>
        <p>Quis suae urbis conservatorem Codrum, quis Erechthei <i>italic text</i> filiasnon maxime laudat? De vacuitate doloris eadem sententia erit.</p>
        <p>Primum in <b>bold text</b> est, quid meminerimus? Collige omnia, quae soletis: <a href="#">inline link</a>. Nihil opus est exemplis hoc facere longius. Duarum enim vitarum nobis erunt instituta capienda. Quid igitur, inquit, eos responsuros putas? Summum a vobis bonum voluptas dicitur. Sed haec omittamus; Quid, cum fictas fabulas, e quibus utilitas nulla elici potest, cum voluptate legimus?</p>
        <h2>H2 Tellus Ridiculus Mollis Bibendum Etiam Venenatis Ultricies Vestibulum</h2>
        <div class="row">
          <div class="col-6">
            <ul>
              <li>Eam si varietatem diceres, intellegerem, ut etiam non dicente te intellego</li>
              <li>Hanc quoque iucunditatem, si vis, transfer in animum;</li>
              <li>Ergo hoc quidem apparet, nos ad agendum esse natos.</li>
            </ul>
          </div>
          <div class="col-6">
            <ol>
              <li>Quo modo autem philosophus loquitur? </li>
              <li>Scio enim esse quosdam, qui quavis lingua philosophari possint</li>
              <li>Non potes, nisi retexueris illa. Haec para/doca illi, nos admirabilia dicamus.</li>
            </ol>
          </div>
        </div>
        <p>Sed posuere consectetur est at lobortis. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
        <h3>H3 Fusce Ridiculus Nibh Vestibulum Tellus Aenean Mollis Adipiscing Mattis Mollis Vehicula</h3>
        <p>Cras mattis consectetur purus sit amet fermentum.</p>
        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Nulla vitae elit libero, a pharetra augue. Curabitur blandit tempus porttitor. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
        <p>Maecenas faucibus mollis interdum. Nullam id dolor id nibh ultricies vehicula ut id elit. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Cras justo odio, dapibus ac facilisis in, egestas eget quam.</p>
        <p><a class="btn" href="#">Button</a></p>
        <h4>H4 Nibh Egestas Tortor Ligula Etiam Tortor Vestibulum Consectetur Fermentum Quam Aenean Dolor Bibendum Nibh</h4>
        <p>Vivamus sagittis lacus <b>vel augue laoreet</b> rutrum faucibus dolor auctor. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras justo odio, dapibus ac facilisis in, egestas eget quam.</p>
        <blockquote cite="– Someone McPerson, M.D.">
          <p>Blockquote tristique magna sit amet purus. Senectus et netus et malesuada. Ac turpis egestas maecenas pharetra. Ultricies integer quis auctor elit sed vulputate mi. Vulputate dignissim suspendisse in est ante.</p>
        </blockquote>
        <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget <i>lacinia odio sem</i> nec elit. Nullam id dolor id nibh ultricies vehicula ut id elit. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
        <h5>H5 Cras Nullam Ultricies Cursus Vulputate Justo Consectetur Nibh Pellentesque Nullam Dapibus Tellus Egestas Tortor</h5>
        <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam porta sem malesuada magna mollis euismod.</p>
        <h6>H6 Purus Tristique Cursus Vulputate Quam Aenean Dapibus Amet Vulputate Mollis Tristique Condimentum Consectetur Ornare Elit</h6>
        <p>Aenean lacinia bibendum nulla sed consectetur. Donec ullamcorper nulla non metus auctor fringilla.</p>
        <blockquote class="test-quote" cite="Somebody | You Used To Know">
          <p class="test-quote">Lorem ipsum dolor sit amet, rebum munere te cum, no sint debet cum. Ei ferri illum luptatum his, id vim probo facilisi. Mea ea debitis definitiones, eum rebum option iudicabit te, est no reque elitr. </p>
        </blockquote>
      </article>
    </section>
    <hr/>
    <!-- Type Scale -->
    <section>
      <h3>Type Scale</h3>
      <table cellpadding="10">
        <thead>
          <tr>
            <th class="w">rem</th>
            <th class="w">px</th>
            <th>Rendered</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="font-weight:700">3.125rem</td>
            <td>50 px</td>
            <td><h1 class='jumbo'>Sample Text<code style="vertical-align:middle;">.jumbo</code></h1></td>
          </tr>
          <tr>
            <td style="font-weight:700">2.1875rem</td>
            <td>35 px</td>
            <td><h1>Sample Text<code style="vertical-align:middle;">h1, .h1</code></h1></td>
          </tr>
          <tr>
            <td style="font-weight:700">1.875rem</td>
            <td>30 px</td>
            <td><h2>Sample Text<code style="vertical-align:middle;">h2, .h2</code></h2></td>
          </tr>
          <tr>
            <td style="font-weight:700">1.5rem</td>
            <td>24 px</td>
            <td><h3>Sample Text<code style="vertical-align:middle;">h3, .h3</code></h3></td>
          </tr>
          <tr>
            <td style="font-weight:700">1.25rem</td>
            <td>20 px</td>
            <td><h4>Sample Text<code style="vertical-align:middle;">h4, .h4</code></h4></td>
          </tr>
          <tr>
            <td style="font-weight:700">1rem</td>
            <td>16 px</td>
            <td><h5>Sample Text<code style="vertical-align:middle;">h5, .h5</code></h5></td>
          </tr>
          <tr>
            <td style="font-weight:700">0.875rem</td>
            <td>14 px</td>
            <td><h6>Sample Text<code style="vertical-align:middle;">h6, .h6</code></h6></td>
          </tr>
        </tbody>
      </table>
    </section>
  </main>
</template>

<script>
    export default {
        name: 'sg-typography'
    }
</script>

<style lang="less">

</style>
