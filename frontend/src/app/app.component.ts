import { Component } from '@angular/core';
import {Router} from "@angular/router";
import {AuthService} from "./services/auth.service";

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  title = 'Origo - Tech Test';

  constructor(
    private authService: AuthService,
    private router: Router
  ) {
    this.authService.getAuthState().subscribe(state => {
      if (state == 1) {
        this.router.navigate(['clients']);
      } else if (state == 2) {
        this.router.navigate(['']);
      }
    });
  }
}
