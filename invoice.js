document.addEventListener('DOMContentLoaded', function() {
    let script = function(){
        this.showClock = function(){
            let dateObj = new Date();
            let months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            
            let year = dateObj.getFullYear();
            let monthNum = dateObj.getMonth();
            let dateCal = dateObj.getDate();
            let hour = dateObj.getHours();
            let min = dateObj.getMinutes();
            let sec = dateObj.getSeconds();
    
            let timeFormat = this.to12HourFormat(hour);
    
            // Format: March 9, 2024 11:32 PM
            // Show the time on the HTML page
            let timeAndDateElement = document.getElementById('tad'); // Select by ID
            if (timeAndDateElement) {
                timeAndDateElement.innerHTML = months[monthNum] + ' ' + dateCal + ',' + year + ' ' + timeFormat['time'] + ':' + min + ':' + sec + ' ' + timeFormat['am_pm'];
            } else {
                console.error("Element with ID 'tad' not found.");
            }
            setInterval(this.showClock.bind(this), 1000);
        };
        
        this.to12HourFormat = function(time){
            let am_pm = 'AM';
            if(time == 12){
                time = 12;
                am_pm = 'PM';
            }
            if(time > 12){
                time = time - 12;
                am_pm = 'PM';
            }
            return {
                time: time,
                am_pm: am_pm
            };
        }
        this.registerEvents = function(){
            document.addEventListener('click',function(e){
                let targetEl = e.target;
                let targetELClassList = targetEl.classList;
                //if click is add to oorder
                //user click on product image , or product info
                let addToOrderClass = ['productImage','productName','productPrice'];

               if(targetELClassList.contains('productImage')||
                targetELClassList.contains('productName')||
                targetELClassList.contains('productPrice')){
                    
                //show the 
                let productContainer = targetEl.closest('div.productColContainer');
                let pid = productContainer.dataset.pid;
                let productInfo = loadScript.products[pid];
               
                
            }
            });
        }
    
        this.initialize = function(){
            this.showClock();
            //register events
            this.registerEvents();
        };
    };
    
    let loadScript = new script();
    loadScript.initialize();
    

        
    });
    