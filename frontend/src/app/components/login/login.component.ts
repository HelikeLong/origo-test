import { Component, OnInit } from '@angular/core';
import {AuthService} from "../../services/auth.service";
import {Router} from "@angular/router";

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {
  loginForm: { user: any, password: any } = {user: '', password: ''};

  constructor(
    private authService: AuthService
  ) { }

  ngOnInit(): void {
  }

  loginUser(event) {
    event.preventDefault();
    if (!this.authService.login(this.loginForm)) {
      alert('Falha ao realizar o login');
    }
  }
}
