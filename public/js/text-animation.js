
// JS FOR TEXT ANIMATOR 

    // new TextAnimator(element);

    /**
     * How to use it?
     * let LOADER_TEXT_ELE = document.getElementsByClassName('animate-loading-text');
        let loaderTextArray = Array.from(LOADER_TEXT_ELE);
        loaderTextArray.forEach((element)=>{
            new TextAnimator(element);
        });
     */


    class TextAnimator {
        constructor(element, speed = 200) {
            this.element = element;
            this.originalText = element.textContent;
            this.speed = speed;
            this.currentIndex = 0;
            this.interval = null;
            this.start();
        }
        
        start() {
            if (this.interval) {
                clearInterval(this.interval);
            }
            
            this.interval = setInterval(() => {
                this.animate();
            }, this.speed);
        }
        
        stop() {
            if (this.interval) {
                clearInterval(this.interval);
                this.interval = null;
            }
            this.element.textContent = this.originalText;
        }
        
        animate() {
            // Reset previous animation step
            let chars = this.originalText.split('');
            
            // Make current character uppercase
            if (this.currentIndex < chars.length) {
                chars[this.currentIndex] = chars[this.currentIndex].toUpperCase();
            }
            
            // Update the displayed text
            this.element.textContent = chars.join('');
            
            // Move to next character
            this.currentIndex = (this.currentIndex + 1) % (this.originalText.length + 1);
            
            // If we've reached the end, reset to original text briefly before starting over
            if (this.currentIndex === this.originalText.length) {
                setTimeout(() => {
                    this.element.textContent = this.originalText;
                }, this.speed / 2);
            }
        }
    }


    