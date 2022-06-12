import { ApiPropertyOptional } from '@nestjs/swagger';
import { Type } from 'class-transformer';
import { IsInt, IsOptional } from 'class-validator';

export class FindTransactionDto {
  @ApiPropertyOptional()
  @IsInt()
  @IsOptional()
  @Type(() => Number)
  index?: number;

  @ApiPropertyOptional()
  @IsInt()
  @IsOptional()
  @Type(() => Number)
  step?: number;

  @ApiPropertyOptional()
  @IsOptional()
  query?: string;

  @ApiPropertyOptional()
  @IsOptional()
  filterName?: string;

  @ApiPropertyOptional()
  @IsOptional()
  filterValue?: string;
}
