<template>
  <main class="container slim-container">
    <section>
      <div class="pattern" id="button-default">
        <details class="pattern-details" open="">
          <summary class="pattern-name">Primary Button <a class="pattern-link" rel="bookmark" href="/?url=/elements/forms/button-default.html" title="View just this pattern">#</a></summary>
            <code class="pattern-markup language-markup">
              <pre>&lt;a class=&quot;btn&quot; href=&quot;#&quot;&gt;Primary&lt;/a&gt;</pre>
              <pre>&lt;button&gt;Primary&lt;/button&gt;</pre>
              <pre>&lt;input type=&quot;submit&quot; value=&quot;Primary&quot;&gt;</pre>
            </code>
              <pre class="pattern-usage"><strong>Usage:</strong> </pre>
          </details>
          <div class="pattern-preview">
            <a class="btn" href="#">Primary</a>
            <button>Primary</button>
            <input type="submit" value="Primary">
          </div>
      </div>
      <div class="pattern" id="button-default">
        <details class="pattern-details" open="">
          <summary class="pattern-name">Secondary Button <a class="pattern-link" rel="bookmark" href="/?url=/elements/forms/button-default.html" title="View just this pattern">#</a></summary>
            <code class="pattern-markup language-markup">
              <pre>&lt;a class=&quot;btn btn-secondary&quot; href=&quot;#&quot;&gt;Secondary&lt;/a&gt;</pre>
              <pre>&lt;button class=&quot;btn-secondary&quot; &gt;Secondary&lt;/button&gt;</pre>
              <pre>&lt;input class=&quot;btn-secondary&quot; type=&quot;submit&quot; value=&quot;Secondary&quot;&gt;</pre>
            </code>
              <pre class="pattern-usage"><strong>Usage:</strong> </pre>
          </details>
          <div class="pattern-preview">
            <a class="btn btn-secondary" href="#">Secondary</a>
            <button class="btn-secondary">Secondary</button>
            <input class="btn-secondary" type="submit" value="Secondary">
          </div>
      </div>
      <div class="pattern" id="button-default">
        <details class="pattern-details" open="">
          <summary class="pattern-name">Small Button <a class="pattern-link" rel="bookmark" href="/?url=/elements/forms/button-default.html" title="View just this pattern">#</a></summary>
            <code class="pattern-markup language-markup">
              <pre>&lt;a class=&quot;btn btn-sm&quot; href=&quot;#&quot;&gt;Small&lt;/a&gt;</pre>
              <pre>&lt;button class=&quot;btn-sm&quot; &gt;Small&lt;/button&gt;</pre>
              &lt;input class=&quot;btn-sm&quot; type=&quot;submit&quot; value=&quot;Primary&quot;&gt;
            </code>
              <pre class="pattern-usage"><strong>Usage:</strong> </pre>
          </details>
          <div class="pattern-preview">
            <a class="btn btn-sm" href="#">Small</a>
            <button class="btn-sm">Small</button>
            <input class="btn-sm" type="submit" value="Small">
          </div>
      </div>
      <div class="pattern" id="button-default">
        <details class="pattern-details" open="">
          <summary class="pattern-name">Small Button <a class="pattern-link" rel="bookmark" href="/?url=/elements/forms/button-default.html" title="View just this pattern">#</a></summary>
            <code class="pattern-markup language-markup">
              <pre>&lt;a class=&quot;btn btn-sm btn-secondary&quot; href=&quot;#&quot;&gt;Small&lt;/a&gt;</pre>
              <pre>&lt;button class=&quot;btn-sm btn-secondary&quot; &gt;Small&lt;/button&gt;</pre>
              &lt;input class=&quot;btn-sm btn-secondary&quot; type=&quot;submit&quot; value=&quot;Primary&quot;&gt;
            </code>
              <pre class="pattern-usage"><strong>Usage:</strong> </pre>
          </details>
          <div class="pattern-preview">
            <a class="btn btn-sm btn-secondary" href="#">Small</a>
            <button class="btn-sm btn-secondary">Small</button>
            <input class="btn-sm btn-secondary" type="submit" value="Small">
          </div>
      </div>
      <div class="pattern" id="button-default">
        <details class="pattern-details" open="">
          <summary class="pattern-name">Disabled Button <a class="pattern-link" rel="bookmark" href="/?url=/elements/forms/button-default.html" title="View just this pattern">#</a></summary>
            <code class="pattern-markup language-markup">
              <pre>&lt;a class=&quot;btn btn-disabled&quot; href=&quot;#&quot;&gt;Disabled&lt;/a&gt;</pre>
              <pre>&lt;a class=&quot;btn btn-disabled&quot; href=&quot;#&quot;&gt;Disabled&lt;/a&gt;</pre>
              <pre>&lt;button class=&quot;btn-disabled&quot; &gt;Disabled&lt;/button&gt;</pre>
            </code>
              <pre class="pattern-usage"><strong>Usage:</strong> </pre>
          </details>
          <div class="pattern-preview">
            <a class="btn btn-disabled" href="" >Disabled</a>
            <a class="btn btn-disabled" href="" >Disabled</a>
            <button class="btn-disabled" disabled>Disabled</button>
          </div>
      </div>

      <div class="pattern" id="button-default">
        <details class="pattern-details" open="">
          <summary class="pattern-name">Icon Button <a class="pattern-link" rel="bookmark" href="/?url=/elements/forms/button-default.html" title="View just this pattern">#</a></summary>
            <code class="pattern-markup language-markup">
              <pre>&lt;a class=&quot;btn btn-secondary btn-icon&quot; href=&quot;#&quot;&gt;<br>  &lt;icon href=&quot;pointer-right&quot;&gt;&lt;/icon&gt;<br />&lt;/a&gt;</pre>
              <pre>&lt;button class=&quot;btn btn-secondary btn-icon&quot;&gt;<br>  &lt;icon href=&quot;pointer-right&quot;&gt;&lt;/icon&gt;<br>&lt;/button&gt;</pre>
              <pre>&lt;label class=&quot;btn btn-secondary btn-icon&quot;&gt;<br>  &lt;input class=&quot;&quot; type=&quot;submit&quot; value=&quot;submit&quot;/&gt;<br>  &lt;icon href=&quot;pointer-right&quot;&gt;&lt;/icon&gt;<br>&lt;/label&gt;</pre>
            </code>
              <pre class="pattern-usage"><strong>Usage:</strong> </pre>
          </details>
          <div class="pattern-preview">
            <a class="btn btn-secondary btn-icon" href="#">
            <icon href="pointer-right"></icon>
          </a>
          <button class="btn btn-secondary btn-icon">
            <icon href="pointer-right"></icon>
          </button>

          <label class="btn btn-secondary btn-icon">
            <input class="" type="submit" value="submit"/>
            <icon href="pointer-right"></icon>
          </label>

          </div>
      </div>
    </section>
  </main>
</template>
<script>
    export default {
        name: 'sg-buttons'
    };
</script>
<style lang="scss">

</style>
