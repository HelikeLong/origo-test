import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'joiner'
})
export class JoinerPipe implements PipeTransform {

  transform(arrayToJoin: Array<any>, joinBy?: string) {
    if (arrayToJoin && arrayToJoin.map) {
      return arrayToJoin.map(item => item.name).join(joinBy || ", ");
    }
    throw new Error('joiner pipe only expects an Array as a first argument');
  }

}
