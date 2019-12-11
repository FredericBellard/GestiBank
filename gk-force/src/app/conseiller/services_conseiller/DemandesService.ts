import {HttpClient, HttpHeaders, HttpErrorResponse}  from "@angular/common/http";
import {Demande} from "./../modeles_conseiller/demandes";
import {Observable, throwError} from "rxjs";
import {Injectable} from "@angular/core";
import { tap, catchError } from 'rxjs/operators';

@Injectable()
// Classe qui va nous permettre d'aller récupérer les services
export class DemandesService
{
    // Url qui nous permet de récupérer les services dans Postman : 
    private apiUrl='http://localhost/gkForce/conseiller_demandes.php';

    constructor(private http: HttpClient){}

    findAll():Observable<Demande[]>
    {
        return this.http.get<Demande[]>(this.apiUrl);
    }

    update(d:Demande):Observable<Demande>{
        const httpOptions = {
            headers: new HttpHeaders({
              'Content-Type':  'multipart/formdata',
              'Access-Control-Allow-Methods': '*'
            })};
          return this.http.put<Demande>(this.apiUrl, d, httpOptions)
          .pipe(
            tap(data => console.log('All: ' + JSON.stringify(data))),
            catchError(this.handleError)
          );
    } 

    private handleError(err: HttpErrorResponse) {
        let errorMessage = '';
        if (err.error instanceof ErrorEvent) {
          // A client-side or network error occurred. Handle it accordingly.
          errorMessage = `An error occurred: ${err.error.message}`;
        } else {
          // The backend returned an unsuccessful response code.
          // The response body may contain clues as to what went wrong,
          errorMessage = `Server returned code: ${err.status}, error message is: ${err.message}`;
        }
        console.error(errorMessage);
        return throwError(errorMessage);
      }
}