import { ApiProperty } from '@nestjs/swagger';

export class CreateCollectionDto {
  @ApiProperty()
  quantity: number;
  @ApiProperty()
  itemsId: string;
  @ApiProperty()
  entitiesId: string;
}
