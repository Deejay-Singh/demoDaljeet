package com
{	
	import flash.display.MovieClip;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.media.SoundMixer;
	import flash.media.SoundTransform;
	import flash.net.navigateToURL;
	import flash.net.URLLoader;
	import flash.net.URLRequest;
	import flash.net.URLVariables;
	import flash.net.URLLoaderDataFormat;
	import flash.net.URLRequestMethod;
	import flash.display.Loader;
	import flash.events.DataEvent;
	import flash.printing.*;
	
	import flash.geom.Rectangle;
	
	
	import com.loading.AssestLoader;
	import com.loading.MediaLoader;
	import com.loading.XmlLoader;
	
	//import com.greensock.TweenMax;
	//import com.greensock.easing.*;

	/**
	 * ...
	 * @author rakesh kumar
	 * @version 1.0
	 * ...
	 */
	
	public class shell extends MovieClip 
	{
		
		private var courseXml:XML = new XML();
		private var path:String = "";
		private var soundTrans:SoundTransform;
		public var soundVolume:Number;
		
		private var xmlLoader:XmlLoader;
		private var mLoader:MediaLoader;
		private var assestLoader:AssestLoader;
		
		private var course_id:String = "";
		private var course_name:String = "";
		private var splashSWF:String = "";
		private var homeSWF:String = "";
		
		private var courseArr:Array = new Array();
		
		private var currentTopic:Number = new Number(0);
		private var currentPage:Number = new Number(0);
		
		private var totalTopics:Number = new Number(0);
		private var totalPages:Number = new Number(0);
		
		private var totalSlides:Number = new Number(0);
		private var visitedSlides:Number = new Number(0);
		
		private var popupOpen:Boolean = false;
		
		public function shell()
		{
			addEventListener(Event.ADDED_TO_STAGE, initShell);
		}
		private function initShell(e:Event):void
		{
			//path = this.loaderInfo.loaderURL;			
			preloader_mc.visible = true;
			progress_panel_mc.visible = false;
			bginfo_panel_mc.visible = false;
			
			mail_popup_mc.visible = false;
			preloader_mc._txt.text="Loading...";
			
			this.tabChildren = false;
			this.tabEnabled = false;
									
			initAllAssets();
		}
		private function initAllAssets()
		{
			soundTrans = new SoundTransform();
			soundVolume = 1;
			sound_off_mc.visible = false;
			//play_mc.visible 	 = false;
			
			xmlLoader = new XmlLoader();
			xmlLoader.loadXml(path + "xml/course.xml", courseXMLLoaded);
			
			//next_mc.visible = false;
			//back_mc.visible = false;
			
		}
		
		private function courseXMLLoaded(cXml:XML)
		{
			courseXml = cXml;
			course_id = cXml.@id;			
			course_name = cXml.@name;
			splashSWF = path+cXml.splash.text();// get splash page swf name
			homeSWF=cXml.home.text(); // get home page swf name
			var topicList:XMLList = XMLList(cXml.topic);
			totalPages = 0;
			trace("course_id :"+course_id);
			trace("course_name "+course_name);
			trace("splashSWF "+splashSWF);
			trace("topicList "+topicList.length());
			for (var i:int = 0; i < topicList.length(); i++ )
			{
				trace(topicList[i].page.length())
				var tempArr = new Array();
				for(var j=0;j <topicList[i].page.length(); j++){
					totalSlides++;
					tempArr[j] = topicList[i].page[j].swfName.text();
				}
				courseArr.push(tempArr);				
				totalTopics = topicList.length();
				totalPages = courseArr[0].length;
			}
			trace("totalSlides: "+totalSlides);	
			trace(courseArr[0]);
			
			
			initAllListener();
		}
		
		private function initAllListener(){
			EnableMovieClip(close_mc)			
			close_mc.addEventListener(MouseEvent.CLICK, closeShell);
			
			//EnableMovieClip(next_mc)			
			next_mc.addEventListener(MouseEvent.CLICK, showNextPage);
			
			//DisableMovieClip(back_mc)
			back_mc.addEventListener(MouseEvent.CLICK, showPreviousPage);
			
			//EnableMovieClip(sound_off_mc)
			sound_off_mc.addEventListener(MouseEvent.CLICK, soundOn);
			
			//EnableMovieClip(sound_on_mc)
			sound_on_mc.addEventListener(MouseEvent.CLICK, soundOff);
			
			//EnableMovieClip(play_mc)
			play_mc.addEventListener(MouseEvent.CLICK, playCurrentSlide);
			
			//EnableMovieClip(pause_mc)
			pause_mc.addEventListener(MouseEvent.CLICK, pauseCurrentSlide);
			
			//EnableMovieClip(replay_mc)
			replay_mc.addEventListener(MouseEvent.CLICK, replayCurrentSlide);
			
			bginfo_btn.addEventListener(MouseEvent.CLICK, openBgInfoPanel);
			bginfo_panel_mc.bginfo_close_btn.addEventListener(MouseEvent.CLICK, hideBginfoPanel);
			
			progress_btn.addEventListener(MouseEvent.CLICK, openProgressPanel);
			
			progress_panel_mc.progress_close_btn.addEventListener(MouseEvent.CLICK, hideProgressPanel);
			progress_panel_mc.email_btn.addEventListener(MouseEvent.CLICK, showeMailPopup);
			progress_panel_mc.print_btn.addEventListener(MouseEvent.CLICK, printPopup);
			
			mail_popup_mc.mail_close_btn.addEventListener(MouseEvent.CLICK, hideeMailPopup);
			mail_popup_mc.cancel_btn.addEventListener(MouseEvent.CLICK, hideeMailPopup);
			mail_popup_mc.submit_btn.addEventListener(MouseEvent.CLICK, submiteMail);
			
			//EnableMovieClip(transcript_mc)
			transcript_mc.transcript_panel_mc.trans_close_btn.addEventListener(MouseEvent.CLICK, hideTranscript);
			transcript_mc.transcript_panel_mc.trans_open_btn.addEventListener(MouseEvent.CLICK, showTranscript);
			
			//EnableMovieClip(help_mc)
			help_mc.addEventListener(MouseEvent.CLICK, showhelp);
			
			glossary_mc.addEventListener(MouseEvent.CLICK, showglossary);
			
			transcript_mc.play();
			
			//mLoader=new MediaLoader().load(splashSWF, splash_home_Loaded, progressHandler, "splashPageSWF");
			
			currentPage = 0;
			currentTopic = 0;
			loadCurrentPage();
			
			addEventListener("SET_MOVIE_STATE", SetMovieState);
			addEventListener("SLIDE_COMPLETE", slideEnd);
			addEventListener("SET_VOLUME", setVolume)
			
			//transcript_panel_mc.visible = false;
		}
		
		private function printPopup(e:MouseEvent){
			trace("print command send...")
			printMovieClip(progress_panel_mc);
		}
		private function printMovieClip(clip:MovieClip) {

			var printJob:PrintJob = new PrintJob();
			var numPages:int = 0;
			var printArea:Rectangle;
			var printHeight:Number;
			var printY:int = 0;
					
			if ( printJob.start()) {
		
				/* Resize movie clip to fit within page width */
				if (clip.progress_txt_mc.width > printJob.pageWidth) {
					clip.progress_txt_mc.width = printJob.pageWidth;
					//clip.scaleY = clip.scaleX;
				}
		
				/* Store reference to print area in a new variable! Will save on scaling calculations later... */
				printArea = new Rectangle(0, 0, printJob.pageWidth/clip.progress_txt_mc.scaleX, printJob.pageHeight/clip.progress_txt_mc.scaleY);
		
				numPages = Math.ceil(clip.progress_txt_mc.height / printJob.pageHeight);
		
				/* Add pages to print job */
				for (var i:int = 0; i < numPages; i++) {
					printJob.addPage(clip.progress_txt_mc, printArea);
					printArea.y += printArea.height;
				}
		
				/* Send print job to printer */
				printJob.send();
		
				/* Delete job from memory */
				printJob = null;
		
			}
			
		}
		
		private function printMovieClip1(clip:MovieClip) {

			var printJob:PrintJob = new PrintJob();
			
			var pageAdded:Boolean = false;
			
			var printOption:PrintJobOptions = new PrintJobOptions();
			printOption.printAsBitmap = false;	
			clip.scaleY = clip.scaleX = 0.75;
	
			if (printJob.start()) {
				 printJob.addPage(clip, new Rectangle(0, 0,100,100),printOption);
				/*for(var p=0; p<pagesToPrint.length; p++){
					printJob.addPage(pagesToPrint[p], new Rectangle(0,0,700,1200),printOption);
				}*/
			}
			//if (pageAdded) {
				printJob.send();
			//}
			
			
		}

		
		private function submiteMail(e:MouseEvent){
			trace("submiteMail")
			var n = mail_popup_mc.name_txt.text;
			var space = n.indexOf(" ")
			//trace(space)
			var mail=mail_popup_mc.mail_txt.text;
			var atpos=mail.indexOf("@");
			var dotpos=mail.lastIndexOf(".");
			//
			if (n== "" || space == 0)
			 {
			  trace("First name must be filled out");
			  //return false;
			 }else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=mail.length)
			  {
			  	trace("Not a valid e-mail address");
			 // return false;
			  }else{
			
				sendData();
				trace("mail send")
			  }
			  trace("mail send.......")
			
		}
		private function sendData():void
		{
			
			var str ="";
			for(var i=0; i<=currentPage; i++){
				str += courseXml.topic[currentTopic].page[i].progressTxt.text()+"<br>";
			}
			var urlvars: URLVariables = new URLVariables();
			urlvars.uname = mail_popup_mc.name_txt.text;
			urlvars.msg = "Hello "+mail_popup_mc.name_txt.text+",<br><br>"+"Here are your simulation results.<br><br><br>"+str;
			//urlvars.msg = unescape("this is a message");
			urlvars.mailId = mail_popup_mc.mail_txt.text;
			
			var loader:URLLoader = new URLLoader();
			//var urlreq:URLRequest = new URLRequest("http://www.games4enjoy.in/rehman/pearson/mail.php");
			var urlreq:URLRequest = new URLRequest("mail.php");
			urlreq.method = URLRequestMethod.POST;
			loader.dataFormat = URLLoaderDataFormat.TEXT;
			//loader.dataFormat = URLLoaderDataFormat.VARIABLES;
			
			urlreq.data = urlvars;
			trace("urlvars.uname: "+urlvars.uname)
			trace("urlvars.msg: "+urlvars.msg)
			trace("urlvars.email: "+urlvars.mailId)
			loader.addEventListener(Event.COMPLETE, completed);
			loader.load(urlreq);
		}
		
		private function completed(e:Event): void
		{
			var loader2: URLLoader = URLLoader(e.target);
			trace(loader2.data);
			mail_popup_mc.visible = false;
			//resptxt.text = event.target.data.done;
		}
		
		private function hideeMailPopup(e:MouseEvent){
			mail_popup_mc.visible = false;
			
		}
		private function showeMailPopup(e:MouseEvent){
			mail_popup_mc.visible = true;
			
		}
		
		private function openBgInfoPanel(e:MouseEvent){
			
			bginfo_panel_mc.visible = true;
			if(popupOpen){
				unloadHelp();
			}
			progress_panel_mc.visible = false;
			mail_popup_mc.visible = false;
			
		}
		private function hideBginfoPanel(e:MouseEvent){
			
			bginfo_panel_mc.visible = false;
			
		}
		
		private function openProgressPanel(e:MouseEvent){
			
			progress_panel_mc.visible = true;
			if(popupOpen){
				unloadHelp();
			}
			bginfo_panel_mc.visible = false;
			
		}
		
		private function hideProgressPanel(e:MouseEvent){
			
			progress_panel_mc.visible = false;
			
		}
		
		private function showhelp(e:MouseEvent){
			mail_popup_mc.visible = false;
			progress_panel_mc.visible = false;
			mLoader=new MediaLoader().load("pages/help.swf", help_Loaded, progressHandler1, "splashPageSWF");
			
		}
		
		private function showglossary(e:MouseEvent){
			mail_popup_mc.visible = false;
			progress_panel_mc.visible = false;
			
			mLoader=new MediaLoader().load("pages/glossary.swf", help_Loaded, progressHandler1, "splashPageSWF");
			
		}
		
		private function help_Loaded(ldr:Loader,id:String):void
		{
			if(popupOpen){
				unloadHelp();
			}
			/**loaded completion of splash page and home page***/
			help_file_mc.addChild(ldr.content);
			help_file_mc.gotoAndPlay(1);
			preloader_mc.visible = false;
			
			mLoader = null;
			popupOpen = true;
		}
		
		public function unloadHelp(){
			
			help_file_mc.removeChildAt(help_file_mc.numChildren - 1);
			popupOpen = false;
		}
		
		
		private function hideTranscript(e:MouseEvent){
			
			transcript_mc.play();
			/*if(transcript_panel_mc.visible){
				transcript_panel_mc.visible = false;
			}else{
				transcript_panel_mc.visible = true;
			}
			*/
			
		}
		
		private function showTranscript(e:MouseEvent){
			
			transcript_mc.play();
			/*if(transcript_panel_mc.visible){
				transcript_panel_mc.visible = false;
			}else{
				transcript_panel_mc.visible = true;
			}*/
			
		}
		
		private function SetMovieState(e:DataEvent):void 
		{
			//trace(e);

			/*
			if (e.data == "pause") {
				pause_mc.visible = false;
				play_mc.visible = true;				
			}
			else {
				pause_mc.visible = true;
				play_mc.visible = false;
			}
			*/
			
		}
		
		public function slideEnd(e:DataEvent)
		{
			trace("slide end")
			//next_mc.gotoAndPlay("_anim");
		
		}
		
		private function splash_home_Loaded(ldr:Loader,id:String):void
		{
			/**loaded completion of splash page and home page***/
			splash_mc.addChild(ldr.content);
			splash_mc.gotoAndPlay(1);
			preloader_mc.visible = false;
			
			mLoader = null;
		}
		private function progressHandler(per:Number,id:String):void
		{
			trace("progress: " + per);
			//preloader_mc._txt.text = "Loading " + Math.floor(per) + "%...";
			preloader_mc._txt.text = "Loading... ";
			SoundMixer.stopAll();
		}
		
		private function progressHandler1(per:Number,id:String):void
		{
			trace("progress: " + per);
			//preloader_mc._txt.text = "Loading " + Math.floor(per) + "%...";
			preloader_mc._txt.text = "Loading... ";
			
		}
		
		public function hideSplash(){
			currentPage = 0;
			currentTopic = 0;
			
			splash_mc.removeChildAt(splash_mc.numChildren - 1);
			if(homeSWF.indexOf(".swf") != -1){
				mLoader=new MediaLoader().load(homeSWF, splash_home_Loaded, progressHandler, "homePageSWF");
				
			}else{
				loadCurrentPage()
			}
		}
		
		public function hideHome(){
			splash_mc.removeChildAt(splash_mc.numChildren - 1);
			loadCurrentPage();
		}
		
		
		
		private function swfLoaded(ldr:Loader,id:String)
		{	
			/************* Releasing the memory ***************/
			page_mc.addChild(ldr.content);
			page_mc.gotoAndPlay(1);
			//dispatchEvent(new DataEvent("PLAY_NEXT_SWF", true, true, "0"));
			preloader_mc.visible = false;
			mLoader = null;
			//progress_mc.init(MovieClip(page_mc.getChildAt(0)))
		}
		
			
		private function replayCurrentSlide(e:MouseEvent){
			
			trace("replay current page... ");
			pause_mc.visible=true;
			play_mc.visible=true;
			//EnableMovieClip(play_mc);
			//EnableMovieClip(pause_mc);
			MovieClip(page_mc.getChildAt(0)).gotoAndPlay(1);
			//progress_mc.init(MovieClip(page_mc.getChildAt(0)))
			
		}
		
		private function pauseCurrentSlide(e:MouseEvent)
		{
			MovieClip(page_mc.getChildAt(0)).stop();
			e.currentTarget.visible=false;
			play_mc.visible=true;
		}
		
		private function playCurrentSlide(e:MouseEvent)
		{	
			MovieClip(page_mc.getChildAt(0)).play();
			
			e.currentTarget.visible=false;
			pause_mc.visible=true;
		}
		
		
		private function setVolume(e:DataEvent)
		{	
			soundVolume = Number(e.data);
			soundTrans.volume= soundVolume;
			SoundMixer.soundTransform = soundTrans;
			if (soundVolume == 0)
			{
				sound_on_mc.visible = false;
				sound_off_mc.visible=true;
			}
			else
			{
				sound_on_mc.visible = true;
				sound_off_mc.visible=false;
			}
		}
		
		
		private function soundOn(e:MouseEvent)
		{	
			sound_on_mc.visible=true;
			sound_off_mc.visible=false;
			//sound_slider_mc.enable();
			//sound_slider_mc.dragger_mc.gotoAndStop("on");
			soundTrans.volume= soundVolume;
			SoundMixer.soundTransform = soundTrans;
			//sound_slider_mc.setVolume(soundVolume);
		}
		
		private function soundOff(e:MouseEvent)
		{	
			sound_off_mc.visible=true;
			sound_on_mc.visible=false;
			//sound_slider_mc.disable();
			//sound_slider_mc.dragger_mc.gotoAndStop("off");
			soundTrans.volume= 0;
			SoundMixer.soundTransform = soundTrans;
			//sound_slider_mc.setVolume(0);
		}
		
		private function showNextPage(e:MouseEvent=null){
			
			//if(visitedSlides)
			currentPage++;
			//trace("currentPage.... "+currentPage+" .... "+courseArr[currentTopic].length);
			//trace("currentTopic.. "+currentTopic+" .... "+courseArr.length);
			if((courseArr.length-1) == currentTopic && (courseArr[currentTopic].length-1)== currentPage){
				trace("disable next mc")
				next_mc.mouseEnabled = false;
				next_mc.visible = false;
				//DisableMovieClip(next_mc);
			}else if(courseArr[currentTopic].length == currentPage){
				currentTopic++
				currentPage = 0;
				
			}
			EnableMovieClip(back_mc)
			/*trace("--------------------------")
			trace("currentTopic....... "+currentTopic);
			trace("currentPage...... "+currentPage);
			
			trace("--------------------------")*/
			pause_mc.visible = true;
			play_mc.visible = true;
			loadCurrentPage();
		}
		
		private function showCourseProgress(){
			trace("****************")
			trace("visitedSlides: "+visitedSlides);
			trace("totalSlides "+totalSlides);
			var tempVisitedPage = 0;
			for(var i = 0; i<=currentTopic; i++){
				if(i == currentTopic){
					for(var j=0; j<=currentPage; j++){
						tempVisitedPage++;
					}
				}else{
					tempVisitedPage+= courseArr[i].length;
				}
			}
			trace("tempVisitedPage "+tempVisitedPage)
			trace("visitedSlides "+visitedSlides)
			if(tempVisitedPage >= visitedSlides){
				trace("if..")
				visitedSlides = tempVisitedPage;
				//showCourseProgress();
			}
			var per = Math.floor((visitedSlides/totalSlides)*100);
			trace("per "+per);
			//course_progress_mc.perTxt.text = String(per)+"%";
			course_progress_mc.progress_fill.scaleX = (per/100);
			
		}
		private function showPreviousPage(e:MouseEvent){
			//if(visitedSlides)
			currentPage--;
			trace("________________________________________")
			trace("currentPage.... "+currentPage);
			trace("currentTopic.. "+currentTopic);
			trace("________________________________________")
			if(currentTopic == 0 && currentPage == 0){
				trace("disable next mc")
				DisableMovieClip(back_mc);
			}else if(currentPage == -1){
				currentTopic--
				currentPage = (courseArr[currentTopic].length-1)
			}
			//EnableMovieClip(next_mc);
			loadCurrentPage();
			
		}
		private function loadCurrentPage(){
			preloader_mc.visible = true;
			while (page_mc.numChildren > 0 )
			{
				page_mc.removeChildAt(page_mc.numChildren - 1);
			}
			showCourseProgress();
			var swfName = courseArr[currentTopic][currentPage];
			mLoader=new MediaLoader().load(swfName, swfLoaded, progressHandler, "currentPageSWF");	
			
			transcript_mc.transcript_panel_mc.txt.htmlText = courseXml.topic[currentTopic].page[currentPage].transcript.text();
			bginfo_panel_mc.progress_txt_mc.progressTxt.htmlText = courseXml.topic[currentTopic].page[currentPage].bgInfoTxt.text();
			trace(bginfo_panel_mc.progress_txt_mc.progressTxt.htmlText)
			
			
			var str ="";
			for(var i=0; i<=currentPage; i++){
				str += courseXml.topic[currentTopic].page[i].progressTxt.text()+"<br>";
			}
			progress_panel_mc.progress_txt_mc.progressTxt.htmlText = str;
			
			page_no_txt.text = String((currentPage+1)+" of "+courseArr[currentTopic].length)
			//trace("..rrrrr........."+courseXml.topic.@name)
			pageTitleTxt.text = courseXml.@name;
			
			
			trace(page_no_txt.text)
			trace("currentPage: "+currentPage)
			//trace(progress_panel_mc.progress_txt_mc.progressTxt.maxScrollV);
			//transcript_mc.transcript_panel_mc.scrollbar_mc.refresh();
			if(transcript_mc.transcript_panel_mc.txt.maxScrollV>1){
				transcript_mc.transcript_panel_mc.scrollbar_mc.visible = true;
				
				transcript_mc.transcript_panel_mc.scrollbar_mc.scrollTarget = transcript_mc.transcript_panel_mc.txt
			}else{
				transcript_mc.transcript_panel_mc.scrollbar_mc.visible = false;
			}
			//transcript_mc.transcript_panel_mc.scrollbar_mc.targetName = "transcript_mc.transcript_panel_mc.txt";
			
			
			if(progress_panel_mc.progress_txt_mc.progressTxt.maxScrollV>1){
				progress_panel_mc.progress_txt_mc.scrollbar_mc.visible = true;
				progress_panel_mc.progress_txt_mc.scrollbar_mc.scrollTarget = progress_panel_mc.progress_txt_mc.progressTxt
			}else{
				progress_panel_mc.progress_txt_mc.scrollbar_mc.visible = false;
			}
			
			if(bginfo_panel_mc.progress_txt_mc.progressTxt.maxScrollV>1){
				bginfo_panel_mc.progress_txt_mc.scrollbar_mc.visible = true;
				bginfo_panel_mc.progress_txt_mc.scrollbar_mc.scrollTarget = bginfo_panel_mc.progress_txt_mc.progressTxt
			}else{
				bginfo_panel_mc.progress_txt_mc.scrollbar_mc.visible = false;
			}
			
		}
		
		
		private function stopSound() {
			SoundMixer.stopAll()
		}
		private function closeShell(e:MouseEvent)
		{
			
			//ExternalInterface.call("closeWindow");
		}
		
		
		
		
		private function EnableMovieClip(mc:MovieClip)
		{	
			mc.buttonMode=true;
			mc.mouseChildren=false;
			mc.mouseEnabled=true;
			mc.alpha=1;
		}
		private function DisableMovieClip(mc:MovieClip)
		{	
			mc.mouseEnabled=false;
			mc.alpha=0.5	
		}
		
		
	}
}