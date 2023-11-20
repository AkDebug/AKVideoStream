# AKVideoStream
<p>AKVideoStream is a Composer library designed to handle video streaming in PHP. This is the trial version of the library, and you can start using it soon.</p>
<p>In this version:</p>
<ul>
<li>You can use temporary links to protect your video file links.</li>
<li>You can also create permanent links.</li>
</ul>
<p>Upcoming versions: Future releases will focus on video management, quality conversion, and usability improvements.</p>
<h4>Explanation:</h4>
<ol>
<li>
<p><strong>Include Autoloader:</strong></p>
<ul>
<li>The code starts by including the Composer autoloader, which is necessary for loading the classes automatically. This ensures that the required classes from the AKVideoStream library are available.</li>
</ul>
<div class="bg-black rounded-md">
<div class="flex items-center relative text-gray-200 bg-gray-800 gizmo:dark:bg-token-surface-primary px-4 py-2 text-xs font-sans justify-between rounded-t-md">&nbsp;</div>
<div class="p-4 overflow-y-auto"><code class="!whitespace-pre hljs language-php"><span class="hljs-keyword">require_once</span> <span class="hljs-string">'vendor/autoload.php'</span>;
</code></div>
</div>
</li>
<li>
<p><strong>Create Video Instance:</strong></p>
<ul>
<li>An instance of the <code>Video</code> class from the <code>Ak\Videostream</code> namespace is created. This instance will be used to work with video streaming functionality.</li>
</ul>
<div class="bg-black rounded-md">
<div class="flex items-center relative text-gray-200 bg-gray-800 gizmo:dark:bg-token-surface-primary px-4 py-2 text-xs font-sans justify-between rounded-t-md">&nbsp;</div>
<div class="p-4 overflow-y-auto"><code class="!whitespace-pre hljs language-php"><span class="hljs-variable">$video</span> = <span class="hljs-keyword">new</span> <span class="hljs-title class_">\Ak\Videostream\Video</span>();
</code></div>
</div>
</li>
<li>
<p><strong>Set Encryption Key and Initialization Vector (IV):</strong></p>
<ul>
<li>The encryption key and initialization vector (IV) are set using the <code>setKey</code> and <code>setIV</code> methods. These parameters are essential for video encryption and decryption.</li>
</ul>
<div class="bg-black rounded-md">
<div class="p-4 overflow-y-auto"><code class="!whitespace-pre hljs language-php"><span class="hljs-variable">$video</span>-&gt;<span class="hljs-title function_ invoke__">setKey</span>(<span class="hljs-string">'395f426c0e5bd914375837483b791d80854dd9a19dd86fd189e94ccade60123'</span>);
<span class="hljs-variable">$video</span>-&gt;<span class="hljs-title function_ invoke__">setIV</span>(<span class="hljs-string">'0000000000001234'</span>);
</code></div>
</div>
</li>
<li>
<p><strong>Set Video Path:</strong></p>
<ul>
<li>The path to the video file is set using the <code>setPath</code> method. This specifies the location of the video file that will be streamed.</li>
</ul>
<div class="bg-black rounded-md">
<div class="flex items-center relative text-gray-200 bg-gray-800 gizmo:dark:bg-token-surface-primary px-4 py-2 text-xs font-sans justify-between rounded-t-md">&nbsp;</div>
<div class="p-4 overflow-y-auto"><code class="!whitespace-pre hljs language-php"><span class="hljs-variable">$video</span>-&gt;<span class="hljs-title function_ invoke__">setPath</span>(<span class="hljs-string">'test2.mp4'</span>);
</code></div>
</div>
</li>
<li>
<p><strong>Check for Token in URL:</strong></p>
<ul>
<li>The code checks if a <code>token</code> parameter is present in the URL using <code>isset($_GET['token'])</code>.</li>
</ul>
<div class="bg-black rounded-md">
<div class="flex items-center relative text-gray-200 bg-gray-800 gizmo:dark:bg-token-surface-primary px-4 py-2 text-xs font-sans justify-between rounded-t-md">&nbsp;</div>
<div class="p-4 overflow-y-auto"><code class="!whitespace-pre hljs language-php"><span class="hljs-keyword">if</span> (<span class="hljs-keyword">isset</span>(<span class="hljs-variable">$_GET</span>[<span class="hljs-string">'token'</span>])) {
</code></div>
</div>
</li>
<li>
<p><strong>Decrypt Video if Token is Present:</strong></p>
<ul>
<li>If a token is present, the <code>Decrypt</code> method is called to decrypt the video using the provided token.</li>
</ul>
<div class="bg-black rounded-md">
<div class="p-4 overflow-y-auto"><code class="!whitespace-pre hljs language-php"><span class="hljs-variable">$video</span>-&gt;<span class="hljs-title function_ invoke__">Decrypt</span>(<span class="hljs-variable">$_GET</span>[<span class="hljs-string">'token'</span>]);
</code></div>
</div>
</li>
<li>
<p><strong>Generate Token and Provide Link if Token is Not Present:</strong></p>
<ul>
<li>If no token is present, a new token is generated using the <code>Encrypt</code> method. The code then echoes a link containing the generated token.</li>
</ul>
<div class="bg-black rounded-md">
<div class="flex items-center relative text-gray-200 bg-gray-800 gizmo:dark:bg-token-surface-primary px-4 py-2 text-xs font-sans justify-between rounded-t-md">&nbsp;</div>
<div class="p-4 overflow-y-auto"><code class="!whitespace-pre hljs language-php"><span class="hljs-keyword">echo</span> <span class="hljs-variable">$_SERVER</span>[<span class="hljs-string">'HTTP_HOST'</span>] . <span class="hljs-variable">$_SERVER</span>[<span class="hljs-string">'REQUEST_URI'</span>] . <span class="hljs-string">"?token="</span> . <span class="hljs-variable">$video</span>-&gt;<span class="hljs-title function_ invoke__">Encrypt</span>();
</code></div>
</div>
</li>
</ol>
<p>This code essentially sets up the AKVideoStream library, configures encryption parameters, and provides logic to either decrypt a video if a token is provided in the URL or generate a new token with a link if no token is present.</p>
