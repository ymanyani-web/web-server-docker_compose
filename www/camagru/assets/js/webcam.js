(function(window) {
    var _userMedia;

    
    function WebcamError() {
        var temp = Error.apply(this, arguments);
        temp.name = this.name = "WebcamError";
        this.stack = temp.stack;
        this.message = temp.message;
    }
    
    
    var Webcam = {
        version: '1.0.26',
        
        // globals
        protocol: location.protocol.match(/https/i) ? 'https' : 'http',
        //loaded: false,    true when webcam movie finishes loading
        //live: false,      true when webcam is initialized and ready to snap
        userMedia: true, // true when getUserMedia is supported natively
    
        params: {
            width: 0,
            height: 0,
            dest_width: 0,         // size of captured image
            dest_height: 0,        // these default to width/height
            image_format: 'jpeg',  // image format (may be jpeg or png)
            jpeg_quality: 900,      // jpeg image quality from 0 (worst) to 100 (best)∂ß
        },
    
        errors: {
            WebcamError: WebcamError
        },
        
        hooks: {}, // callback hook functions
        
        init: function() {
            // initialize, check for getUserMedia support
            var self = this;
            
            // Setup getUserMedia, with polyfill for older browsers
            this.mediaDevices = (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) ? 
                navigator.mediaDevices : ((navigator.mozGetUserMedia || navigator.webkitGetUserMedia) ? {
                    getUserMedia: function(c) {
                        return new Promise(function(y, n) {
                            (navigator.mozGetUserMedia ||
                            navigator.webkitGetUserMedia).call(navigator, c, y, n);
                        });
                    }
            } : null);
            
            window.URL = window.URL || window.webkitURL || window.mozURL || window.msURL;
            this.userMedia = this.userMedia && !!this.mediaDevices && !!window.URL;
            
            // Older versions of firefox (< 21) apparently claim support but user media does not actually work
            if (navigator.userAgent.match(/Firefox\D+(\d+)/)) {
                if (parseInt(RegExp.$1, 10) < 21) this.userMedia = null;
            }
            
            // Make sure media stream is closed when navigating away from page
            if (this.userMedia) {
                window.addEventListener( 'beforeunload', function(event) {
                    self.reset();
                } );
            }
        },
        

        
        attach: function(elem) {
            // create webcam preview and attach to DOM element
            // pass in actual DOM reference, ID, or CSS selector
            if (typeof(elem) == 'string') {
                elem = document.getElementById(elem) || document.querySelector(elem);
            }
            if (!elem) {
                return this.dispatch('error', new WebcamError("Could not locate DOM element to attach to."));
            }
            this.container = elem;
            elem.innerHTML = ''; // start with empty element
            // insert "peg" so we can insert our preview canvas adjacent to it later on
            var peg = document.createElement('div');
            elem.appendChild( peg );
            this.peg = peg;
            // set width/height if not already set
            if (!this.params.width) this.params.width = elem.offsetWidth;
            if (!this.params.height) this.params.height = elem.offsetHeight;
            // make sure we have a nonzero width and height at this point
            if (!this.params.width || !this.params.height) {
                return this.dispatch('error', new WebcamError("No width and/or height for webcam.  Please call set() first, or attach to a visible element."));
            }
            // set defaults for dest_width / dest_height if not set
            if (!this.params.dest_width) this.params.dest_width = this.params.width;
            if (!this.params.dest_height) this.params.dest_height = this.params.height;
            
            this.userMedia = _userMedia === undefined ? this.userMedia : _userMedia;
            // if force_flash is set, disable userMedia
            if (this.params.force_flash) {
                _userMedia = this.userMedia;
                this.userMedia = null;
            }
            // check for default fps
            if (typeof this.params.fps !== "number") this.params.fps = 30;
            // adjust scale if dest_width or dest_height is different
            var scaleX = this.params.width / this.params.dest_width;
            var scaleY = this.params.height / this.params.dest_height;
            
            if (this.userMedia) {
                // setup webcam video container
                var video = document.createElement('video');
                video.setAttribute('autoplay', 'autoplay');
                video.setAttribute('playsinline', 'playsinline');
                video.style.width = '' + this.params.dest_width + 'px';
                video.style.height = '' + this.params.dest_height + 'px';
                // add video element to dom
                elem.appendChild( video );
                this.video = video;
                // ask user for access to their camera
                var self = this;
                this.mediaDevices.getUserMedia({
                /*     "audio": false, */
                    "video": this.params.constraints || {
                        mandatory: {
                            minWidth: this.params.dest_width,
                            minHeight: this.params.dest_height
                        }
                    }
                })
                .then( function(stream) {
                    // got access, attach stream to video
                    video.onloadedmetadata = function(e) {
                        self.loaded = true;
                    };
                    // as window.URL.createObjectURL() is deprecated, adding a check so that it works in Safari.
                    // older browsers may not have srcObject
                    if ("srcObject" in video) {
                          video.srcObject = stream;
                    }
                    else {
                          // using URL.createObjectURL() as fallback for old browsers
                          video.src = window.URL.createObjectURL(stream);
                    }
                })
            }


            // setup final crop for live preview
            if (this.params.crop_width && this.params.crop_height) {
                var scaled_crop_width = Math.floor( this.params.crop_width * scaleX );
                var scaled_crop_height = Math.floor( this.params.crop_height * scaleY );
                
                elem.style.width = '' + scaled_crop_width + 'px';
                elem.style.height = '' + scaled_crop_height + 'px';
                elem.style.overflow = 'hidden';
                
                elem.scrollLeft = Math.floor( (this.params.width / 2) - (scaled_crop_width / 2) );
                elem.scrollTop = Math.floor( (this.params.height / 2) - (scaled_crop_height / 2) );
            }
            else {
                // no crop, set size to desired
                elem.style.width = '' + this.params.width + 'px';
                elem.style.height = '' + this.params.height + 'px';
            }
        },
        

        
        set: function() {
            // set one or more params
            // variable argument list: 1 param = hash, 2 params = key, value
            if (arguments.length == 1) {
                for (var key in arguments[0]) {
                    this.params[key] = arguments[0][key];
                }
            }
            else {
                this.params[ arguments[0] ] = arguments[1];
            }
        },
        

        
        snap: function(user_callback, user_canvas) {
            // take snapshot and return image data uri
            var self = this;
            var params = this.params;
            
            if (!this.loaded) return this.dispatch('error', new WebcamError("Webcam is not loaded yet"));
            
            // if we have an active preview freeze, use that
            if (this.preview_active) {
                this.savePreview( user_callback, user_canvas );
                return null;
            }
            // create offscreen canvas element to hold pixels
            var canvas = document.createElement('canvas');
            canvas.width = this.params.dest_width;
            canvas.height = this.params.dest_height;
            var context = canvas.getContext('2d');
            // create inline function, called after image load (flash) or immediately (native)
            var func = function() {
                // fire user callback if desired
                user_callback(
                    user_canvas ? null : canvas.toDataURL('image/' + params.image_format, params.jpeg_quality / 100 ),
                    canvas,
                    context
                );
            };
            // grab image frame from userMedia or flash movie
            if (this.userMedia) {
                // native implementation
                context.drawImage(this.video, 0, 0, this.params.dest_width, this.params.dest_height);
                // fire callback right away
                func();
            }
            return null;
        },
        b64ToUint6: function(nChr) {
            // convert base64 encoded character to 6-bit integer
            return nChr > 64 && nChr < 91 ? nChr - 65
                : nChr > 96 && nChr < 123 ? nChr - 71
                : nChr > 47 && nChr < 58 ? nChr + 4
                : nChr === 43 ? 62 : nChr === 47 ? 63 : 0;
        },
        base64DecToArr: function(sBase64, nBlocksSize) {
            // convert base64 encoded string to Uintarray
            var sB64Enc = sBase64.replace(/[^A-Za-z0-9\+\/]/g, ""), nInLen = sB64Enc.length,
                nOutLen = nBlocksSize ? Math.ceil((nInLen * 3 + 1 >> 2) / nBlocksSize) * nBlocksSize : nInLen * 3 + 1 >> 2, 
                taBytes = new Uint8Array(nOutLen);
            
            for (var nMod3, nMod4, nUint24 = 0, nOutIdx = 0, nInIdx = 0; nInIdx < nInLen; nInIdx++) {
                nMod4 = nInIdx & 3;
                nUint24 |= this.b64ToUint6(sB64Enc.charCodeAt(nInIdx)) << 18 - 6 * nMod4;
                if (nMod4 === 3 || nInLen - nInIdx === 1) {
                    for (nMod3 = 0; nMod3 < 3 && nOutIdx < nOutLen; nMod3++, nOutIdx++) {
                        taBytes[nOutIdx] = nUint24 >>> (16 >>> nMod3 & 24) & 255;
                    }
                    nUint24 = 0;
                }
            }
            return taBytes;
        },
        upload: function(image_data_uri, target_url, callback) {
            // submit image data to server using binary AJAX
            var form_elem_name = this.params.upload_name || 'webcam';
            // detect image format from within image_data_uri
            var image_fmt = '';
            if (image_data_uri.match(/^data\:image\/(\w+)/))
                image_fmt = RegExp.$1;
            // extract raw base64 data from Data URI
            var raw_image_data = image_data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
            // contruct use AJAX object
            var http = new XMLHttpRequest();
            http.open("POST", target_url, true);
            // completion handler
            var self = this;
            http.onload = function() {
                if (callback) callback.apply( self, [http.status, http.responseText, http.statusText] );
                Webcam.dispatch('uploadComplete', http.status, http.responseText, http.statusText);
            };
            // create a blob and decode our base64 to binary
            var blob = new Blob( [ this.base64DecToArr(raw_image_data) ], {type: 'image/'+image_fmt} );
            // stuff into a form, so servers can easily receive it as a standard file upload
            var form = new FormData();
            form.append( form_elem_name, blob, form_elem_name+"."+image_fmt.replace(/e/, '') );
            // send data to server
            http.send(form);
        }
    };
  
    
    Webcam.init();
    
    if (typeof define === 'function' && define.amd) {
        define( function() { return Webcam; } );
    } 
    else if (typeof module === 'object' && module.exports) {
        module.exports = Webcam;
    } 
    else {
        window.Webcam = Webcam;
    }
    
    }(window));
