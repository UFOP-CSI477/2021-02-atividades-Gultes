import { ApiProperty } from '@nestjs/swagger';

export class CreateEntityDto {
  @ApiProperty()
  name: string;
  @ApiProperty()
  district: string;
  @ApiProperty()
  city: string;
  @ApiProperty()
  state: string;
}
