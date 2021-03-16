import {Injectable} from '@angular/core';
import {
    HttpRequest,
    HttpHandler,
    HttpEvent,
    HttpInterceptor
} from '@angular/common/http';
import {Observable} from "rxjs";

@Injectable()
export class TokenInterceptor implements HttpInterceptor {
    constructor(
    ) {}

    intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
        const token = window.localStorage.getItem('USER_DATA');
        if (token) {
            request = request.clone({
                setHeaders: {
                    'Authorization': `Bearer ${token}`
                }
            });
        }
        return next.handle(request);
    }
}
