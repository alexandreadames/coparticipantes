import { Component, OnInit } from '@angular/core';
import * as Rellax from 'rellax';


@Component({
  selector: 'app-landing',
  templateUrl: './landing.component.html',
  styleUrls: ['./landing.component.scss']
})
export class LandingComponent implements OnInit {
  data : Date = new Date();
  focus;
  focus1;

  constructor() { }

  ngOnInit() {
    var rellaxHeader = new Rellax('.rellax-header');

    var body = document.getElementsByTagName('body')[0];
    body.classList.add('landing-page');
    var navbar = document.getElementsByTagName('nav')[0];
    navbar.classList.add('navbar-transparent');

    window.addEventListener('scroll', this.scroll, true); //third parameter

  }
  ngOnDestroy(){
    var body = document.getElementsByTagName('body')[0];
    body.classList.remove('landing-page');
    var navbar = document.getElementsByTagName('nav')[0];
    navbar.classList.remove('navbar-transparent');

    window.removeEventListener('scroll', this.scroll, true);
  }

  scroll = (): void => {
    //handle your scroll here
    //notice the 'odd' function assignment to a class field
    //this is used to be able to remove the event listener
    var navbar = document.getElementsByTagName('nav')[0];
    if(window.scrollY >= navbar.offsetHeight) {
      // var body = document.getElementsByTagName('body')[0];
      // body.classList.remove('landing-page');
      var navbar = document.getElementsByTagName('nav')[0];
      navbar.classList.remove('navbar-transparent');
    } 
    else {
      // var body = document.getElementsByTagName('body')[0];
      // body.classList.add('landing-page');
      var navbar = document.getElementsByTagName('nav')[0];
      navbar.classList.add('navbar-transparent');
    }
  };
}
