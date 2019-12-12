import { HttpClient, HttpErrorResponse, HttpRequest, HttpHeaders } from "@angular/common/http";
import { Conseiller } from "../modeles/Conseiller";
import { Injectable } from "@angular/core";
import { Observable, throwError } from 'rxjs';
import { catchError, tap, map } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
// Classe qui va nous permettre d'aller récupérer les services
export class ConseillerService {
  private conseillerUrl = 'http://localhost/gk-force/conseiller.php';

 constructor(private http: HttpClient) { }
  getObservableConseillers(): Observable<Conseiller[]> {
    return this.http.get<Conseiller[]>(this.conseillerUrl)
      .pipe(
        tap(data => console.log('All: ' + JSON.stringify(data))),
        catchError(this.handleError)
      );
  }


  findAll(): Observable<Conseiller[]> {
    return this.http.get<Conseiller[]>(this.conseillerUrl);
  }


  getConseiller(nomConseiller: string): Observable<Conseiller | undefined> {
    var newUrl = this.conseillerUrl+"/"+nomConseiller;
    console.log (newUrl);
    return this.http.get<Conseiller>(this.conseillerUrl+"/"+ nomConseiller);
    
    /*getObservableConseillers()
      .pipe(
        map((conseillers: Conseiller[]) => conseillers.find(p => p.id_user === 1))
      ); 
      */
  }

  updateConseiller(conseiller:Conseiller):Observable<Conseiller>{
    // var newUrl=this.conseillerUrl+"/conseiller";
    //console.log (newUrl);
    return this.http.put<Conseiller>(this.conseillerUrl,conseiller);
  } 


  saveConseiller(conseiller: Conseiller): Observable<Conseiller> {
    console.log('start save conseiller service');
    const httpOptions = {
      headers: new HttpHeaders({
        'Content-Type':  'application/json',
        'Access-Control-Allow-Methods': '*',
        'Access-Control-Allow-Headers': 'Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With'
      })};
    return this.http.post<Conseiller>(this.conseillerUrl, conseiller)
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